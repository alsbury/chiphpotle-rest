<?php

namespace Chiphpotle\Rest\Test;

use Chiphpotle\Rest\Client;
use Chiphpotle\Rest\Enum\UpdateOperation;
use Chiphpotle\Rest\Enum\Permissionship;
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
use Chiphpotle\Rest\Model\DeleteRelationshipsRequest;
use Chiphpotle\Rest\Model\DeleteRelationshipsResponse;
use Chiphpotle\Rest\Model\ExpandPermissionTreeRequest;
use Chiphpotle\Rest\Model\ExpandPermissionTreeResponse;
use Chiphpotle\Rest\Model\ExperimentalRelationshipsBulkexportPostResponse200;
use Chiphpotle\Rest\Model\LookupResourcesRequest;
use Chiphpotle\Rest\Model\LookupSubjectsRequest;
use Chiphpotle\Rest\Model\ObjectReference;
use Chiphpotle\Rest\Model\PermissionsResourcesPostResponse200;
use Chiphpotle\Rest\Model\PermissionsSubjectsPostResponse200;
use Chiphpotle\Rest\Model\ReadRelationshipsRequest;
use Chiphpotle\Rest\Model\Relationship;
use Chiphpotle\Rest\Model\RelationshipFilter;
use Chiphpotle\Rest\Model\RelationshipsReadPostResponse200;
use Chiphpotle\Rest\Model\RelationshipUpdate;
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
        self::getApiClient()->writeSchema(
            new WriteSchemaRequest(SchemaFixtures::SAMPLE_SCHEMA)
        );
    }

    public function testSchemaRead(): void
    {
        $schemaText = $this->getApiClient()
            ->readSchema()
            ->getSchemaText();
        $this->assertStringContainsString('definition user', $schemaText);
        $this->assertStringContainsString('definition document', $schemaText);
        $this->assertStringContainsString('caveat published', $schemaText);
        $this->assertStringContainsString('relation viewer', $schemaText);
        $this->assertStringContainsString('relation writer', $schemaText);
        $this->assertStringContainsString('permission write', $schemaText);
        $this->assertStringContainsString('permission view', $schemaText);
    }

    public function testRelationshipWrite(): void
    {
        $response = $this->writeRelationship('document', 'topsecret2', 'viewer', 'user', 'jimmy');
        $this->assertNotEmpty($response->getWrittenAt()->getToken());
    }

    public function testRelationshipRead(): void
    {
        $filter = (new RelationshipFilter())->setResourceType("document");
        $request = (new ReadRelationshipsRequest())
            ->setConsistency(Consistency::minimizeLatency())
            ->setRelationshipFilter($filter);
        $response = $this->getApiClient()->readRelationships(
            $request
        );
        $this->assertInstanceOf(RelationshipsReadPostResponse200::class, $response);
    }

    public function testRelationshipDelete(): void
    {
        $relationship = new Relationship(
            ObjectReference::create("document", "topsecret2"),
            "viewer",
            SubjectReference::create("user", "jimmy")
        );
        $update = new RelationshipUpdate(
            UpdateOperation::DELETE,
            $relationship
        );
        $request = new WriteRelationshipsRequest([$update]);
        $response = $this->getApiClient()->writeRelationships(
            $request
        );
        $this->assertNotEmpty($response->getWrittenAt()->getToken());
    }

    public function testDeleteRelationships(): void
    {
        $this->writeRelationship('document', 'topsecret6', 'viewer', 'user', 'john');
        $this->writeRelationship('document', 'topsecret6', 'viewer', 'user', 'tom');

        $request = new DeleteRelationshipsRequest(new RelationshipFilter('document', 'topsecret6', 'viewer'));

        $response = $this->getApiClient()->deleteRelationships($request);

        $this->assertInstanceOf(DeleteRelationshipsResponse::class, $response);
    }

    public function testLookupResources(): void
    {
        $this->writeRelationship('document', 'topsecret1', 'viewer', 'user', 'lookup_resource_test');
        $writeResults = $this->writeRelationship('document', 'topsecret2', 'viewer', 'user', 'lookup_resource_test');

        $request = new LookupResourcesRequest();
        $request
            ->setResourceObjectType("document")
            ->setPermission("view")
            ->setSubject(SubjectReference::create("user", "lookup_resource_test"))
            ->setConsistency(Consistency::atLeastAsFresh($writeResults->getWrittenAt()));

        $response = $this->getApiClient()->lookupResources(
            $request
        );

        $this->assertInstanceOf(PermissionsResourcesPostResponse200::class, $response);
        $results = $response->getResults();
        $this->assertCount(2, $results);

        foreach ($results as $result) {
            $this->assertTrue(in_array($result->getResourceObjectId(), ['topsecret1', 'topsecret2']));
        }
    }

    public function testLookupSubjects(): void
    {
        $this->writeRelationship('document', 'lookup_subject_test', 'viewer', 'user', 'alice');
        $this->writeRelationship('document', 'lookup_subject_test', 'viewer', 'user', 'mary');

        $request = new LookupSubjectsRequest(
            ObjectReference::create('document', 'lookup_subject_test'),
            'view',
            'user',
            consistency: Consistency::fullyConsistent()
        );
        $response = $this->getApiClient()->lookupSubjects(
            $request
        );

        $this->assertInstanceOf(PermissionsSubjectsPostResponse200::class, $response);
        $results = $response->getResults();
        $this->assertCount(2, $results);

        foreach ($results as $result) {
            $this->assertTrue(in_array($result->getSubjectObjectId(), ['alice', 'mary']));
        }
    }

    public function testPermissionCheckValid(): void
    {
        $writeResponse = $this->writeRelationship('document', 'topsecret1', 'viewer', 'user', 'bob');
        $request = new CheckPermissionRequest(
            ObjectReference::create("document", "topsecret1"),
            "view",
            SubjectReference::create("user", "bob"),
            Consistency::atLeastAsFresh($writeResponse->getWrittenAt())
        );
        $response = $this->getApiClient()->checkPermission(
            $request
        );
        $this->assertEquals(
            Permissionship::HAS_PERMISSION,
            $response->getPermissionship()
        );
    }

    public function testPermissionCheckInvalid(): void
    {
        $request = new CheckPermissionRequest(
            ObjectReference::create("document", "topsecret1"),
            "write",
            SubjectReference::create("user", "alice")
        );
        $response = $this->getApiClient()->checkPermission(
            $request
        );
        $this->assertEquals(
            Permissionship::NO_PERMISSION,
            $response->getPermissionship()
        );
    }

    public function testPermissionCheckValidWithCaveat(): void
    {
        $caveat = new ContextualizedCaveat('published');
        $this->writeRelationship('document', 'published_doc', 'viewer', 'user', 'anon', $caveat);

        $request = new CheckPermissionRequest(
            ObjectReference::create("document", "published_doc"),
            "view",
            SubjectReference::create("user", "anon"),
            ['status' => 'published']
        );
        $response = $this->getApiClient()->checkPermission(
            $request
        );
        $this->assertInstanceOf(CheckPermissionResponse::class, $response);
        $this->assertEquals(
            Permissionship::HAS_PERMISSION,
            $response->getPermissionship()
        );
    }

    public function testPermissionCheckInvalidWithCaveat(): void
    {
        $caveat = new ContextualizedCaveat('published');
        $this->writeRelationship('document', 'draft_doc', 'viewer', 'user', 'anon2', $caveat);

        $request = new CheckPermissionRequest(
            ObjectReference::create("document", "draft_doc"),
            "view",
            SubjectReference::create("user", "anon2"),
            ['status' => 'draft']
        );
        $response = $this->getApiClient()->checkPermission(
            $request
        );
        $this->assertInstanceOf(CheckPermissionResponse::class, $response);
        $this->assertEquals(
            Permissionship::NO_PERMISSION,
            $response->getPermissionship()
        );
    }

    public function testBulkPermissionCheck(): void
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
            $expected = $pair->getRequest()->getResource()->getObjectId() == 'topsecret2' ? Permissionship::NO_PERMISSION : Permissionship::HAS_PERMISSION;
            $this->assertEquals($expected, $pair->getItem()->getPermissionship(), 'Incorrect permission for pair #'.$i);
        }
    }

    public function testBulkRelationshipImport(): void
    {
        $id = random_int(0, getrandmax());
        $request = new BulkImportRelationshipsRequest([
            new Relationship(ObjectReference::create('document', 'blogpost1'), 'writer', SubjectReference::create('user', $id)),
            new Relationship(ObjectReference::create('document', 'blogpost2'), 'writer', SubjectReference::create('user', $id))
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

    public function testBulkRelationshipExport(): void
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

    public function testPermissionCheckExpand(): void
    {
        $request = new ExpandPermissionTreeRequest(
            ObjectReference::create("document", "topsecret1"),
            "view"
        );
        $response = $this->getApiClient()->expandPermissionTree(
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
            UpdateOperation::TOUCH,
            $relationship
        );
        $request = new WriteRelationshipsRequest([$update]);
        return $this->getApiClient()->writeRelationships(
            $request
        );
    }

    public static function getApiClient(): Client
    {
        return Client::create($_ENV['BASE_URL'], $_ENV['API_KEY']);
    }
}
