<?php

namespace Chiphpotle\Rest\Endpoint;

use Chiphpotle\Rest\Model\BulkExportRelationshipsRequest;
use Chiphpotle\Rest\Model\ExperimentalRelationshipsBulkexportPostResponse200;
use Chiphpotle\Rest\Model\RpcStatus;
use Chiphpotle\Rest\Runtime\Client\BaseEndpoint;
use Chiphpotle\Rest\Runtime\Client\Endpoint;
use Chiphpotle\Rest\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

final class ExperimentalServiceBulkExportRelationships extends BaseEndpoint implements Endpoint
{
    use EndpointTrait;

    /**
    * @param BulkExportRelationshipsRequest $body BulkExportRelationshipsRequest represents a resumable request for
    * all relationships from the server.
    */
    public function __construct(BulkExportRelationshipsRequest $body)
    {
        $this->body = $body;
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getUri(): string
    {
        return '/v1/experimental/relationships/bulkexport';
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        return $this->getSerializedBody($serializer);
    }

    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }

    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null): ExperimentalRelationshipsBulkexportPostResponse200|RpcStatus|null
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (200 === $status) {
            return $serializer->deserialize($body, ExperimentalRelationshipsBulkexportPostResponse200::class, 'json');
        }
        return $serializer->deserialize($body, RpcStatus::class, 'json');
    }

    public function getAuthenticationScopes(): array
    {
        return [];
    }
}
