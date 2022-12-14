<?php

namespace Chiphpotle\Rest\Endpoint;

use Chiphpotle\Rest\Model\RpcStatus;
use Chiphpotle\Rest\Model\ReadRelationshipsRequest;
use Chiphpotle\Rest\Model\RelationshipsReadPostResponse200;
use Chiphpotle\Rest\Runtime\Client\BaseEndpoint;
use Chiphpotle\Rest\Runtime\Client\Endpoint as ClientEndpoint;
use Chiphpotle\Rest\Runtime\Client\EndpointTrait;
use Symfony\Component\Serializer\SerializerInterface;

class PermissionsServiceReadRelationships extends BaseEndpoint implements ClientEndpoint
{
    use EndpointTrait;

    /**
    * @param ReadRelationshipsRequest $body ReadRelationshipsRequest specifies one or more filters used to read matching
    * relationships within the system.
    */
    public function __construct(ReadRelationshipsRequest $body)
    {
        $this->body = $body;
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getUri(): string
    {
        return '/v1/relationships/read';
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        return $this->getSerializedBody($serializer);
    }

    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }

    protected function transformResponseBody(string $body, int $status, SerializerInterface $serializer, ?string $contentType = null): RpcStatus|RelationshipsReadPostResponse200|array|null
    {
        if (200 === $status) {
            /**
             * Data returned from this request is a stream of object and needs to be converted to an array of objects
             */
            $parts = explode("\n", trim($body));
            $data = '[' . implode(',', $parts) . ']';
            return $serializer->deserialize($data, 'Chiphpotle\\Rest\\Model\\RelationshipsReadPostResponse200', 'json');
        }
        return $serializer->deserialize($body, 'Chiphpotle\\Rest\\Model\\RpcStatus', 'json');
    }
    public function getAuthenticationScopes(): array
    {
        return [];
    }
}