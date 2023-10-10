<?php

namespace Chiphpotle\Rest\Test;

use Chiphpotle\Rest\Client;
use Chiphpotle\Rest\Enum\RelationshipUpdateOperation;
use Chiphpotle\Rest\Enum\CheckPermissionResponsePermissionship;
use Chiphpotle\Rest\Model\BulkCheckPermissionRequest;
use Chiphpotle\Rest\Model\BulkCheckPermissionRequestItem;
use Chiphpotle\Rest\Model\BulkCheckPermissionResponse;
use Chiphpotle\Rest\Model\BulkExportRelationshipsRequest;
use Chiphpotle\Rest\Model\BulkImportRelationshipsRequest;
use Chiphpotle\Rest\Model\BulkImportRelationshipsResponse;
use Chiphpotle\Rest\Model\CheckPermissionRequest;
use Chiphpotle\Rest\Model\CheckPermissionResponse;
use Chiphpotle\Rest\Model\Consistency;
use Chiphpotle\Rest\Model\ContextualizedCaveat;
use Chiphpotle\Rest\Model\ExpandPermissionTreeRequest;
use Chiphpotle\Rest\Model\ExpandPermissionTreeResponse;
use Chiphpotle\Rest\Model\ExperimentalRelationshipsBulkexportPostResponse200;
use Chiphpotle\Rest\Model\LookupResourcesRequest;
use Chiphpotle\Rest\Model\ObjectReference;
use Chiphpotle\Rest\Model\ReadRelationshipsRequest;
use Chiphpotle\Rest\Model\Relationship;
use Chiphpotle\Rest\Model\RelationshipFilter;
use Chiphpotle\Rest\Model\RelationshipsReadPostResponse200;
use Chiphpotle\Rest\Model\RelationshipUpdate;
use Chiphpotle\Rest\Model\RpcStatus;
use Chiphpotle\Rest\Model\SubjectReference;
use Chiphpotle\Rest\Model\WriteRelationshipsRequest;
use Chiphpotle\Rest\Model\WriteRelationshipsResponse;
use Chiphpotle\Rest\Model\WriteSchemaRequest;
use Chiphpotle\Rest\Runtime\Client\RpcException;
use Chiphpotle\Rest\Test\Fixtures\SchemaFixtures;
use PHPUnit\Framework\TestCase;

final class ClientTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        self::getApiClient()->schemaServiceWriteSchema(
            new WriteSchemaRequest(SchemaFixtures::SAMPLE_SCHEMA)
        );
    }

    public function testSchemaRead()
    {
        $schemaText = $this->getApiClient()
            ->schemaServiceReadSchema()
            ->getSchemaText();
        $this->assertStringContainsString('definition user', $schemaText);
        $this->assertStringContainsString('definition document', $schemaText);
        $this->assertStringContainsString('caveat published', $schemaText);
        $this->assertStringContainsString('relation viewer', $schemaText);
        $this->assertStringContainsString('relation writer', $schemaText);
        $this->assertStringContainsString('permission write', $schemaText);
        $this->assertStringContainsString('permission view', $schemaText);
    }

    public function testRelationshipWrite()
    {
        $response = $this->writeRelationship('document', 'topsecret2', 'viewer', 'user', 'jimmy');
        $this->assertNotEmpty($response->getWrittenAt()->getToken());
    }

    public function testRelationshipRead()
    {
        $filter = (new RelationshipFilter())->setResourceType("document");
        $request = (new ReadRelationshipsRequest())
            ->setConsistency(Consistency::minimizeLatency())
            ->setRelationshipFilter($filter);
        $response = $this->getApiClient()->permissionsServiceReadRelationships(
            $request
        );
        $this->assertInstanceOf(RelationshipsReadPostResponse200::class, $response);
    }

    public function testRelationshipDelete()
    {
        $relationship = new Relationship(
            ObjectReference::create("document", "topsecret2"),
            "viewer",
            SubjectReference::create("user", "jimmy")
        );
        $update = new RelationshipUpdate(
            RelationshipUpdateOperation::DELETE,
            $relationship
        );
        $request = new WriteRelationshipsRequest([$update]);
        $response = $this->getApiClient()->permissionsServiceWriteRelationships(
            $request
        );
        $this->assertNotEmpty($response->getWrittenAt()->getToken());
    }

    public function testLookupResources()
    {
        $this->writeRelationship('document', 'topsecret1', 'viewer', 'user', 'alice');

        $request = new LookupResourcesRequest();
        $request
            ->setResourceObjectType("document")
            ->setPermission("view")
            ->setSubject(SubjectReference::create("user", "alice"))
            ->setConsistency(Consistency::minimizeLatency());
        $response = $this->getApiClient()->permissionsServiceLookupResources(
            $request
        );
        $this->assertEquals(
            "topsecret1",
            $response->getResult()->getResourceObjectId()
        );
    }

    public function testPermissionCheckValid()
    {
        $this->writeRelationship('document', 'topsecret1', 'viewer', 'user', 'bob');
        $request = new CheckPermissionRequest(
            ObjectReference::create("document", "topsecret1"),
            "view",
            SubjectReference::create("user", "bob")
        );
        $response = $this->getApiClient()->permissionsServiceCheckPermission(
            $request
        );
        $this->assertEquals(
            CheckPermissionResponsePermissionship::HAS_PERMISSION,
            $response->getPermissionship()
        );
    }

    public function testPermissionCheckInvalid()
    {
        $request = new CheckPermissionRequest(
            ObjectReference::create("document", "topsecret1"),
            "write",
            SubjectReference::create("user", "alice")
        );
        $response = $this->getApiClient()->permissionsServiceCheckPermission(
            $request
        );
        $this->assertEquals(
            CheckPermissionResponsePermissionship::NO_PERMISSION,
            $response->getPermissionship()
        );
    }

    public function testPermissionCheckValidWithCaveat()
    {
        $caveat = new ContextualizedCaveat('published');
        $this->writeRelationship('document', 'published_doc', 'viewer', 'user', 'anon', $caveat);

        $request = new CheckPermissionRequest(
            ObjectReference::create("document", "published_doc"),
            "view",
            SubjectReference::create("user", "anon"),
            ['status' => 'published']
        );
        $response = $this->getApiClient()->permissionsServiceCheckPermission(
            $request
        );
        $this->assertInstanceOf(CheckPermissionResponse::class, $response);
        $this->assertEquals(
            CheckPermissionResponsePermissionship::HAS_PERMISSION,
            $response->getPermissionship()
        );
    }

    public function testPermissionCheckInvalidWithCaveat()
    {
        $caveat = new ContextualizedCaveat('published');
        $this->writeRelationship('document', 'draft_doc', 'viewer', 'user', 'anon2', $caveat);

        $request = new CheckPermissionRequest(
            ObjectReference::create("document", "draft_doc"),
            "view",
            SubjectReference::create("user", "anon2"),
            ['status' => 'draft']
        );
        $response = $this->getApiClient()->permissionsServiceCheckPermission(
            $request
        );
        $this->assertInstanceOf(CheckPermissionResponse::class, $response);
        $this->assertEquals(
            CheckPermissionResponsePermissionship::NO_PERMISSION,
            $response->getPermissionship()
        );
    }

    public function testBulkPermissionCheck()
    {
        $this->writeRelationship('document', 'topsecret1', 'viewer', 'user', 'larry');
        $this->writeRelationship('document', 'topsecret3', 'viewer', 'user', 'larry');
        $request = new BulkCheckPermissionRequest(
            [
                new BulkCheckPermissionRequestItem(ObjectReference::create('document', 'topsecret1'), 'view', SubjectReference::create('user', 'larry')),
                new BulkCheckPermissionRequestItem(ObjectReference::create('document', 'topsecret2'), 'view', SubjectReference::create('user', 'larry')),
                new BulkCheckPermissionRequestItem(ObjectReference::create('document', 'topsecret3'), 'view', SubjectReference::create('user', 'larry')),
            ]
        );

        try {
            $response = $this->getApiClient()->experimentalServiceBulkCheckPermission($request);
        } catch (RpcException $e) {
            if ($e->getMessage() == 'Not Found') {
                $this->markTestSkipped('Currently running version of spicedb does not support the experimental bulk permission check api');
            }
            throw $e;
        }

        $this->assertInstanceOf(BulkCheckPermissionResponse::class, $response);
        $pairs = $response->getPairs();
        $this->assertCount(3, $pairs);

        foreach ($pairs as $i => $pair) {
            $expected = $pair->getRequest()->getResource()->getObjectId() == 'topsecret2' ? CheckPermissionResponsePermissionship::NO_PERMISSION : CheckPermissionResponsePermissionship::HAS_PERMISSION;
            $this->assertEquals($expected, $pair->getItem()->getPermissionship(), 'Incorrect permission for pair #'.$i);
        }
    }

    public function testBulkRelationshipImport()
    {
        $request = new BulkImportRelationshipsRequest([
            new Relationship(ObjectReference::create('document', 'blogpost1'), 'writer', SubjectReference::create('user', 'mary')),
            new Relationship(ObjectReference::create('document', 'blogpost2'), 'writer', SubjectReference::create('user', 'mary'))
        ]);

        try {
            $response = $this->getApiClient()->experimentalServiceBulkImportRelationships($request);
        } catch (RpcException $e) {
            if ($e->getMessage() == 'Not Found') {
                $this->markTestSkipped('Currently running version of spicedb does not support the experimental bulk relationship import api');
            }
            throw $e;
        }

        $this->assertInstanceOf(BulkImportRelationshipsResponse::class, $response);
        $this->assertNotEmpty($response->getNumLoaded());
    }

    public function testBulkRelationshipExport()
    {
        $this->writeRelationship('document', 'topsecret1', 'writer', 'user', 'joe');

        $request = new BulkExportRelationshipsRequest();

        try {
            $response = $this->getApiClient()->experimentalServiceBulkExportRelationships($request);
        } catch (RpcException $e) {
            if ($e->getMessage() == 'Not Found') {
                $this->markTestSkipped('Currently running version of spicedb does not support the experimental bulk relationship export api');
            }
            throw $e;
        }

        $this->assertInstanceOf(ExperimentalRelationshipsBulkexportPostResponse200::class, $response);
        $this->assertNotEmpty($response->getResult()->getRelationships());
    }

    public function testPermissionCheckExpand()
    {
        $request = new ExpandPermissionTreeRequest(
            ObjectReference::create("document", "topsecret1"),
            "view"
        );
        $response = $this->getApiClient()->permissionsServiceExpandPermissionTree(
            $request
        );
        $this->assertInstanceOf(ExpandPermissionTreeResponse::class, $response);
    }

    private function writeRelationship(string $objectType, string $objectId, string $relation, string $subjectType, string $subjectId, ?ContextualizedCaveat $caveat = null): WriteRelationshipsResponse
    {
        $relationship = new Relationship(
            ObjectReference::create($objectType, $objectId),
            $relation,
            SubjectReference::create($subjectType, $subjectId),
            $caveat
        );
        $update = new RelationshipUpdate(
            RelationshipUpdateOperation::TOUCH,
            $relationship
        );
        $request = new WriteRelationshipsRequest([$update]);
        return $this->getApiClient()->permissionsServiceWriteRelationships(
            $request
        );
    }

    public static function getApiClient(): Client
    {
        return Client::create($_ENV['BASE_URL'], $_ENV['API_KEY']);
    }
}
