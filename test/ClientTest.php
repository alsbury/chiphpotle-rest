<?php

namespace Chiphpotle\Rest\Test;

use Chiphpotle\Rest\Client;
use Chiphpotle\Rest\Enum\RelationshipUpdateOperation;
use Chiphpotle\Rest\Enum\V1CheckPermissionResponsePermissionship;
use Chiphpotle\Rest\Model\CheckPermissionRequest;
use Chiphpotle\Rest\Model\CheckPermissionResponse;
use Chiphpotle\Rest\Model\Consistency;
use Chiphpotle\Rest\Model\ExpandPermissionTreeRequest;
use Chiphpotle\Rest\Model\ExpandPermissionTreeResponse;
use Chiphpotle\Rest\Model\LookupResourcesRequest;
use Chiphpotle\Rest\Model\ObjectReference;
use Chiphpotle\Rest\Model\ReadRelationshipsRequest;
use Chiphpotle\Rest\Model\Relationship;
use Chiphpotle\Rest\Model\RelationshipFilter;
use Chiphpotle\Rest\Model\RelationshipUpdate;
use Chiphpotle\Rest\Model\SubjectReference;
use Chiphpotle\Rest\Model\WriteRelationshipsRequest;
use Chiphpotle\Rest\Model\WriteSchemaRequest;
use Chiphpotle\Rest\Test\Fixtures\SchemaFixtures;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{

    public function test_relationship_read()
    {
        $consistency = new Consistency(null, null, true);
        $filter = new RelationshipFilter();
        $filter->setResourceType("document");
        $request = new ReadRelationshipsRequest();
        $request
            ->setConsistency($consistency)
            ->setRelationshipFilter($filter);
        $response = $this->getApiClient()->permissionsServiceReadRelationships($request);
        $this->assertEquals('Chiphpotle\Rest\Model\RelationshipsReadPostResponse200', get_class($response));
    }

    public function test_relationship_write()
    {
        $relationship = new Relationship(
            new ObjectReference('document', 'topsecret2'),
            'viewer',
            new SubjectReference(
                new ObjectReference('user', 'jimmy')
            )
        );

        $update = new RelationshipUpdate(RelationshipUpdateOperation::TOUCH, $relationship);

        $request = new WriteRelationshipsRequest([$update]);

        $response = $this->getApiClient()->permissionsServiceWriteRelationships($request);
        $this->assertNotEmpty($response->getWrittenAt()->getToken());
    }

    public function test_relationship_delete()
    {
        $relationship = new Relationship(
            new ObjectReference('document', 'topsecret2'),
            'viewer',
            new SubjectReference(
                new ObjectReference('user', 'jimmy')
            )
        );

        $update = new RelationshipUpdate(RelationshipUpdateOperation::DELETE, $relationship);

        $request = new WriteRelationshipsRequest([$update]);

        $response = $this->getApiClient()->permissionsServiceWriteRelationships($request);
        $this->assertNotEmpty($response->getWrittenAt()->getToken());
    }

    public function test_lookup_resources()
    {
        $consistency = new Consistency(
            null,
            null,
            true
        );

        $request = new LookupResourcesRequest();
        $request
            ->setConsistency($consistency)
            ->setResourceObjectType('document')
            ->setPermission('view')
            ->setSubject(
                new SubjectReference(
                    new ObjectReference('user', 'alice')
                )
            );

        $response = $this->getApiClient()->permissionsServiceLookupResources($request);
        $this->assertEquals("topsecret1", $response->getResult()->getResourceObjectId());
    }

    public function test_permission_check_valid()
    {
        $subject = new SubjectReference(
            new ObjectReference('user', 'bob')
        );

        $request = new CheckPermissionRequest(
            $subject,
            'view',
            new ObjectReference('document', 'topsecret1'),
        );
        /** @var CheckPermissionResponse $response */
        $response = $this->getApiClient()->permissionsServiceCheckPermission($request);
        $this->assertEquals(V1CheckPermissionResponsePermissionship::HAS_PERMISSION, $response->getPermissionship());
    }

    public function test_permission_check_expand()
    {
        $request = new ExpandPermissionTreeRequest(
            new ObjectReference(
                'document',
                'topsecret1'
            ),
            'view'
        );
        /** @var CheckPermissionResponse $response */
        $response = $this->getApiClient()->permissionsServiceExpandPermissionTree($request);
        $this->assertEquals(ExpandPermissionTreeResponse::class, get_class($response));
    }

    public function test_permission_check_invalid()
    {
        $subject = new SubjectReference(
            new ObjectReference(
                'user',
                'alice'
            )
        );

        $request = new CheckPermissionRequest(
            $subject,
            'write',
            new ObjectReference('document', 'topsecret1'),
        );
        /** @var CheckPermissionResponse $response */
        $response = $this->getApiClient()->permissionsServiceCheckPermission($request);
        $this->assertEquals($response->getPermissionship(), V1CheckPermissionResponsePermissionship::HAS_PERMISSION);
    }

    public function test_schema_read()
    {
        $schemaText = $this->getApiClient()->schemaServiceReadSchema()->getSchemaText();
        $this->assertEquals(SchemaFixtures::SAMPLE_SCHEMA, $schemaText);
    }

    public function test_schema_write()
    {
        $result = (bool)$this->getApiClient()->schemaServiceWriteSchema(new WriteSchemaRequest(SchemaFixtures::SAMPLE_SCHEMA));
        $this->assertTrue($result, 'Schema write successful');
    }

    /**
     * @return Client
     */
    public function getApiClient(): Client
    {
        return Client::create(
            new \GuzzleHttp\Client(
                [
                    'base_uri' => 'http://spicedb:8443/',
                    'headers' => [
                        'Authorization' => 'Bearer ' . getenv('API_KEY')
                    ]
                ]
            )
        );
    }
}