<?php

namespace Chiphpotle\Rest\Endpoint;

use Chiphpotle\Rest\Model\BulkImportRelationshipsRequest;
use Chiphpotle\Rest\Model\BulkImportRelationshipsResponse;
use Chiphpotle\Rest\Model\RpcStatus;
use Chiphpotle\Rest\Runtime\Client\BaseEndpoint;
use Chiphpotle\Rest\Runtime\Client\Endpoint;
use Chiphpotle\Rest\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class ExperimentalServiceBulkImportRelationships extends BaseEndpoint implements Endpoint
{
    use EndpointTrait;

    /**
    * EXPERIMENTAL
    * https://github.com/authzed/spicedb/issues/1303
    *
    * @param BulkImportRelationshipsRequest $body BulkImportRelationshipsRequest represents one batch of the streaming
    * BulkImportRelationships API. The maximum size is only limited by the backing
    * datastore, and optimal size should be determined by the calling client
    * experimentally. (streaming inputs)
    */
    public function __construct(BulkImportRelationshipsRequest $body)
    {
        $this->body = $body;
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getUri(): string
    {
        return '/v1/experimental/relationships/bulkimport';
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        return $this->getSerializedBody($serializer);
    }

    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }


    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null): BulkImportRelationshipsResponse|RpcStatus
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (200 === $status) {
            return $serializer->deserialize($body, BulkImportRelationshipsResponse::class, 'json');
        }
        return $serializer->deserialize($body, RpcStatus::class, 'json');
    }

    public function getAuthenticationScopes(): array
    {
        return [];
    }
}
