<?php

namespace Chiphpotle\Rest\Test;

use Chiphpotle\Rest\Client;
use Chiphpotle\Rest\Enum\RelationshipUpdateOperation;
use Chiphpotle\Rest\Enum\CheckPermissionResponsePermissionship;
use Chiphpotle\Rest\Model\BulkCheckPermissionRequest;
use Chiphpotle\Rest\Model\BulkCheckPermissionRequestItem;
use Chiphpotle\Rest\Model\BulkCheckPermissionResponse;
use Chiphpotle\Rest\Model\BulkExportRelationshipsRequest;
use Chiphpotle\Rest\Model\BulkExportRelationshipsResponse;
use Chiphpotle\Rest\Model\BulkImportRelationshipsRequest;
use Chiphpotle\Rest\Model\BulkImportRelationshipsResponse;
use Chiphpotle\Rest\Model\CheckPermissionRequest;
use Chiphpotle\Rest\Model\CheckPermissionResponse;
use Chiphpotle\Rest\Model\Consistency;
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
use Chiphpotle\Rest\Test\Fixtures\SchemaFixtures;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        self::getApiClient()->schemaServiceWriteSchema(
            new WriteSchemaRequest(SchemaFixtures::SAMPLE_SCHEMA)
        );
    }

    public function test_schema_read()
    {
        $schemaText = $this->getApiClient()
            ->schemaServiceReadSchema()
            ->getSchemaText();
        $this->assertStringContainsString('definition user', $schemaText);
        $this->assertStringContainsString('definition document', $schemaText);
        $this->assertStringContainsString('relation viewer', $schemaText);
        $this->assertStringContainsString('relation writer', $schemaText);
        $this->assertStringContainsString('permission write', $schemaText);
        $this->assertStringContainsString('permission view', $schemaText);
    }

    public function test_relationship_write()
    {
        $response = $this->writeRelationship('document', 'topsecret2', 'viewer', 'user', 'jimmy');
        $this->assertNotEmpty($response->getWrittenAt()->getToken());
    }

    public function test_relationship_read()
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

    public function test_relationship_delete()
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

    public function test_lookup_resources()
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

    public function test_permission_check_valid()
    {
        $this->writeRelationship('document', 'topsecret1', 'viewer', 'user', 'bob');
        $request = new CheckPermissionRequest(
            ObjectReference::create("document", "topsecret1"),
            "view",
            SubjectReference::create("user", "bob")
        );
        /** @var CheckPermissionResponse $response */
        $response = $this->getApiClient()->permissionsServiceCheckPermission(
            $request
        );
        $this->assertEquals(
            CheckPermissionResponsePermissionship::HAS_PERMISSION,
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

        $response = $this->getApiClient()->experimentalServiceBulkCheckPermission(
            $request
        );

        if ($response instanceof RpcStatus) {
            $this->markTestSkipped('Currently running version of spicedb does not support the experimental bulk permission check api');
        }

        $this->assertInstanceOf(BulkCheckPermissionResponse::class, $response);
        $pairs = $response->getPairs();
        $this->assertCount(3, $pairs);

        foreach ($pairs as $pair) {
            $expected = $pair->getRequest()->getResource()->getObjectId() == 'topsecret2' ? CheckPermissionResponsePermissionship::NO_PERMISSION : CheckPermissionResponsePermissionship::HAS_PERMISSION;
            $this->assertEquals($expected, $pair->getItem()->getPermissionship());
        }
    }

    public function testBulkRelationshipImport()
    {
        $request = new BulkImportRelationshipsRequest([
            new Relationship(ObjectReference::create('document', 'blogpost1'), 'writer', SubjectReference::create('user', 'mary')),
            new Relationship(ObjectReference::create('document', 'blogpost2'), 'writer', SubjectReference::create('user', 'mary'))
        ]);
        $response = $this->getApiClient()->experimentalServiceBulkImportRelationships($request);

        if ($response instanceof RpcStatus) {
            $this->markTestSkipped('Currently running version of spicedb does not support the experimental bulk relationship import api');
        }

        $this->assertInstanceOf(BulkImportRelationshipsResponse::class, $response);
        $this->assertNotEmpty($response->getNumLoaded());
    }

    public function testBulkRelationshipExport()
    {
        $this->writeRelationship('document', 'topsecret1', 'writer', 'user', 'joe');

        $request = new BulkExportRelationshipsRequest();
        $response = $this->getApiClient()->experimentalServiceBulkExportRelationships($request);

        if ($response instanceof RpcStatus) {
            $this->markTestSkipped('Currently running version of spicedb does not support the experimental bulk relationship export api');
        }

        $this->assertInstanceOf(ExperimentalRelationshipsBulkexportPostResponse200::class, $response);
        $this->assertNotEmpty($response->getResult()->getRelationships());
    }

    public function test_permission_check_expand()
    {
        $request = new ExpandPermissionTreeRequest(
            ObjectReference::create("document", "topsecret1"),
            "view"
        );
        /** @var CheckPermissionResponse $response */
        $response = $this->getApiClient()->permissionsServiceExpandPermissionTree(
            $request
        );
        $this->assertEquals(
            ExpandPermissionTreeResponse::class,
            get_class($response)
        );
    }

    public function test_permission_check_invalid()
    {
        $request = new CheckPermissionRequest(
            ObjectReference::create("document", "topsecret1"),
            "write",
            SubjectReference::create("user", "alice")
        );
        /** @var CheckPermissionResponse $response */
        $response = $this->getApiClient()->permissionsServiceCheckPermission(
            $request
        );
        $this->assertEquals(
            CheckPermissionResponsePermissionship::NO_PERMISSION,
            $response->getPermissionship()
        );
    }

    private function writeRelationship(string $objectType, string $objectId, string $relation, string $subjectType, string $subjectId): WriteRelationshipsResponse
    {
        $relationship = new Relationship(
            ObjectReference::create($objectType, $objectId),
            $relation,
            SubjectReference::create($subjectType, $subjectId)
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
