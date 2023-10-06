<?php

namespace Chiphpotle\Rest\Endpoint;

use Chiphpotle\Rest\Model\RpcStatus;
use Chiphpotle\Rest\Model\WriteRelationshipsRequest;
use Chiphpotle\Rest\Model\WriteRelationshipsResponse;
use Chiphpotle\Rest\Runtime\Client\BaseEndpoint;
use Chiphpotle\Rest\Runtime\Client\Endpoint as ClientEndpoint;
use Chiphpotle\Rest\Runtime\Client\EndpointTrait;
use Symfony\Component\Serializer\SerializerInterface;

class PermissionsServiceWriteRelationships extends BaseEndpoint implements ClientEndpoint
{
    use EndpointTrait;

    /**
     * @param WriteRelationshipsRequest $body WriteRelationshipsRequest contains a list of Relationship mutations that
     * should be applied to the service. If the optional_preconditions parameter
     * is included, all of the specified preconditions must also be satisfied before
     * the write will be committed.
     */
    public function __construct(WriteRelationshipsRequest $body)
    {
        $this->body = $body;
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getUri(): string
    {
        return '/v1/relationships/write';
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        return $this->getSerializedBody($serializer);
    }

    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }

    protected function transformResponseBody(string $body, int $status, SerializerInterface $serializer, ?string $contentType = null): RpcStatus|WriteRelationshipsResponse|null
    {
        if (200 === $status) {
            return $serializer->deserialize($body, 'Chiphpotle\\Rest\\Model\\WriteRelationshipsResponse', 'json');
        }
        return $serializer->deserialize($body, 'Chiphpotle\\Rest\\Model\\RpcStatus', 'json');
    }

    public function getAuthenticationScopes(): array
    {
        return [];
    }
}
