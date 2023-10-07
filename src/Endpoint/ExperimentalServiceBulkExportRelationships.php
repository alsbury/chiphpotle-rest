<?php

namespace Chiphpotle\Rest\Endpoint;

use Chiphpotle\Rest\Model\BulkExportRelationshipsRequest;
use Chiphpotle\Rest\Runtime\Client\BaseEndpoint;
use Chiphpotle\Rest\Runtime\Client\Endpoint;
use Chiphpotle\Rest\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class ExperimentalServiceBulkExportRelationships extends BaseEndpoint implements Endpoint
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

    /**
     * {@inheritdoc}
     *
     *
     * @return null|\Chiphpotle\Rest\Model\V1ExperimentalRelationshipsBulkexportPostResponse200|\Chiphpotle\Rest\Model\RpcStatus
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (200 === $status) {
            return $serializer->deserialize($body, 'Chiphpotle\\Rest\\Model\\V1ExperimentalRelationshipsBulkexportPostResponse200', 'json');
        }
        return $serializer->deserialize($body, 'Chiphpotle\\Rest\\Model\\RpcStatus', 'json');
    }

    public function getAuthenticationScopes(): array
    {
        return [];
    }
}