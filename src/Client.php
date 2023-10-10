<?php

namespace Chiphpotle\Rest;

use Chiphpotle\Rest\Endpoint\ExperimentalServiceBulkCheckPermission;
use Chiphpotle\Rest\Endpoint\ExperimentalServiceBulkExportRelationships;
use Chiphpotle\Rest\Endpoint\ExperimentalServiceBulkImportRelationships;
use Chiphpotle\Rest\Endpoint\PermissionsServiceCheckPermission;
use Chiphpotle\Rest\Endpoint\PermissionsServiceDeleteRelationships;
use Chiphpotle\Rest\Endpoint\PermissionsServiceExpandPermissionTree;
use Chiphpotle\Rest\Endpoint\PermissionsServiceLookupResources;
use Chiphpotle\Rest\Endpoint\PermissionsServiceLookupSubjects;
use Chiphpotle\Rest\Endpoint\PermissionsServiceReadRelationships;
use Chiphpotle\Rest\Endpoint\PermissionsServiceWriteRelationships;
use Chiphpotle\Rest\Endpoint\SchemaServiceReadSchema;
use Chiphpotle\Rest\Endpoint\SchemaServiceWriteSchema;
use Chiphpotle\Rest\Model\BulkCheckPermissionRequest;
use Chiphpotle\Rest\Model\BulkCheckPermissionResponse;
use Chiphpotle\Rest\Model\BulkExportRelationshipsRequest;
use Chiphpotle\Rest\Model\BulkImportRelationshipsRequest;
use Chiphpotle\Rest\Model\BulkImportRelationshipsResponse;
use Chiphpotle\Rest\Model\CheckPermissionRequest;
use Chiphpotle\Rest\Model\CheckPermissionResponse;
use Chiphpotle\Rest\Model\DeleteRelationshipsRequest;
use Chiphpotle\Rest\Model\DeleteRelationshipsResponse;
use Chiphpotle\Rest\Model\ExpandPermissionTreeRequest;
use Chiphpotle\Rest\Model\ExpandPermissionTreeResponse;
use Chiphpotle\Rest\Model\ExperimentalRelationshipsBulkexportPostResponse200;
use Chiphpotle\Rest\Model\LookupResourcesRequest;
use Chiphpotle\Rest\Model\LookupSubjectsRequest;
use Chiphpotle\Rest\Model\PermissionsResourcesPostResponse200;
use Chiphpotle\Rest\Model\PermissionsSubjectsPostResponse200;
use Chiphpotle\Rest\Model\ReadRelationshipsRequest;
use Chiphpotle\Rest\Model\ReadSchemaResponse;
use Chiphpotle\Rest\Model\RelationshipsReadPostResponse200;
use Chiphpotle\Rest\Model\WriteRelationshipsRequest;
use Chiphpotle\Rest\Model\WriteRelationshipsResponse;
use Chiphpotle\Rest\Model\WriteSchemaRequest;
use Chiphpotle\Rest\Normalizer\JaneObjectNormalizer;
use Http\Discovery\Psr17FactoryDiscovery;
use stdClass;
use Symfony\Component\Serializer\Encoder\JsonDecode;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Serializer;

final class Client extends Runtime\Client\Client
{
    /**
     * @param BulkCheckPermissionRequest $body
     *
     * @return BulkCheckPermissionResponse
     */
    public function experimentalServiceBulkCheckPermission(BulkCheckPermissionRequest $body): BulkCheckPermissionResponse
    {
        return $this->executeEndpoint(new ExperimentalServiceBulkCheckPermission($body));
    }

    /**
     * @param BulkExportRelationshipsRequest $body BulkExportRelationshipsRequest represents a resumable request for
     * all relationships from the server.
     *
     * @return ExperimentalRelationshipsBulkexportPostResponse200
     */
    public function experimentalServiceBulkExportRelationships(BulkExportRelationshipsRequest $body): ExperimentalRelationshipsBulkexportPostResponse200
    {
        return $this->executeEndpoint(new ExperimentalServiceBulkExportRelationships($body));
    }

    /**
     * EXPERIMENTAL
     * https://github.com/authzed/spicedb/issues/1303
     *
     * @param BulkImportRelationshipsRequest $body
     *
     * @return BulkImportRelationshipsResponse
     */
    public function experimentalServiceBulkImportRelationships(BulkImportRelationshipsRequest $body): BulkImportRelationshipsResponse
    {
        return $this->executeEndpoint(new ExperimentalServiceBulkImportRelationships($body));
    }

    /**
     * @param CheckPermissionRequest $request CheckPermissionRequest issues a check on whether a subject has a permission
     * or is a member of a relation, on a specific resource.
     */
    public function permissionsServiceCheckPermission(CheckPermissionRequest $request): CheckPermissionResponse
    {
        return $this->executeEndpoint(new PermissionsServiceCheckPermission($request));
    }

    /**
     * @param ExpandPermissionTreeRequest $request ExpandPermissionTreeRequest returns a tree representing the expansion of all
     * relationships found accessible from a permission or relation on a particular
     * resource.
     *
     * ExpandPermissionTreeRequest is typically used to determine the full set of
     * subjects with a permission, along with the relationships that grant said
     * access.
     */
    public function permissionsServiceExpandPermissionTree(ExpandPermissionTreeRequest $request): ExpandPermissionTreeResponse
    {
        return $this->executeEndpoint(new PermissionsServiceExpandPermissionTree($request));
    }

    /**
     * @param LookupResourcesRequest $request LookupResourcesRequest performs a lookup of all resources of a particular
     * kind on which the subject has the specified permission or the relation in
     * which the subject exists, streaming back the IDs of those resources.
     */
    public function permissionsServiceLookupResources(LookupResourcesRequest $request): PermissionsResourcesPostResponse200
    {
        return $this->executeEndpoint(new PermissionsServiceLookupResources($request));
    }

    /**
     * @param LookupSubjectsRequest $request LookupSubjectsRequest performs a lookup of all subjects of a particular
     * kind for which the subject has the specified permission or the relation in
     * which the subject exists, streaming back the IDs of those subjects.
     */
    public function permissionsServiceLookupSubjects(LookupSubjectsRequest $request): PermissionsSubjectsPostResponse200
    {
        return $this->executeEndpoint(new PermissionsServiceLookupSubjects($request));
    }

    /**
     * @param DeleteRelationshipsRequest $request DeleteRelationshipsRequest specifies which Relationships should be deleted,
     * requesting the delete of *ALL* relationships that match the specified
     * filters. If the optional_preconditions parameter is included, all of the
     * specified preconditions must also be satisfied before the delete will be
     * executed.
     */
    public function permissionsServiceDeleteRelationships(DeleteRelationshipsRequest $request): DeleteRelationshipsResponse
    {
        return $this->executeEndpoint(new PermissionsServiceDeleteRelationships($request));
    }

    /**
     * @param ReadRelationshipsRequest $request ReadRelationshipsRequest specifies one or more filters used to read matching
     * relationships within the system.
     */
    public function permissionsServiceReadRelationships(ReadRelationshipsRequest $request): RelationshipsReadPostResponse200|array
    {
        return $this->executeEndpoint(new PermissionsServiceReadRelationships($request));
    }

    /**
     * @param WriteRelationshipsRequest $request WriteRelationshipsRequest contains a list of Relationship mutations that
     * should be applied to the service. If the optional_preconditions parameter
     * is included, all of the specified preconditions must also be satisfied before
     * the write will be committed.
     *
     * @return WriteRelationshipsResponse
     */
    public function permissionsServiceWriteRelationships(WriteRelationshipsRequest $request): WriteRelationshipsResponse
    {
        return $this->executeEndpoint(new PermissionsServiceWriteRelationships($request));
    }

    /**
     * Errors include:
     * - INVALID_ARGUMENT: a provided value has failed to semantically validate
     * - NOT_FOUND: no schema has been defined
     *
     *
     * @return ReadSchemaResponse
     */
    public function schemaServiceReadSchema(): ReadSchemaResponse
    {
        return $this->executeEndpoint(new SchemaServiceReadSchema());
    }

    /**
     * @param WriteSchemaRequest $request WriteSchemaRequest is the required data used to "upsert" the Schema of a
     * Permissions System.
     *
     * @return stdClass
     */
    public function schemaServiceWriteSchema(WriteSchemaRequest $request): stdClass
    {
        return $this->executeEndpoint(new SchemaServiceWriteSchema($request));
    }

    public static function create($baseUrl, $apiKey, $additionalNormalizers = []): Client
    {
        $httpClient = new \GuzzleHttp\Client([
            'base_uri' => $baseUrl,
            'headers' => [
                'Authorization' => 'Bearer ' . $apiKey
            ]
        ]);
        $requestFactory = Psr17FactoryDiscovery::findRequestFactory();
        $streamFactory = Psr17FactoryDiscovery::findStreamFactory();
        $normalizers = [new ArrayDenormalizer(), new JaneObjectNormalizer()];
        if (count($additionalNormalizers) > 0) {
            $normalizers = array_merge($normalizers, $additionalNormalizers);
        }
        $serializer = new Serializer($normalizers, [new JsonEncoder(new JsonEncode(), new JsonDecode(['json_decode_associative' => true]))]);
        return new self($httpClient, $requestFactory, $serializer, $streamFactory);
    }
}
