<?php

namespace Chiphpotle\Rest\Endpoint;

use Chiphpotle\Rest\Model\RpcStatus;
use Chiphpotle\Rest\Model\WriteSchemaRequest;
use Chiphpotle\Rest\Runtime\Client\BaseEndpoint;
use Chiphpotle\Rest\Runtime\Client\Endpoint as ClientEndpoint;
use Chiphpotle\Rest\Runtime\Client\EndpointTrait;
use stdClass;
use Symfony\Component\Serializer\SerializerInterface;

class SchemaServiceWriteSchema extends BaseEndpoint implements ClientEndpoint
{
    use EndpointTrait;

    /**
     * @param WriteSchemaRequest $body WriteSchemaRequest is the required data used to "upsert" the Schema of a
     * Permissions System.
     */
    public function __construct(WriteSchemaRequest $body)
    {
        $this->body = $body;
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getUri(): string
    {
        return '/v1/schema/write';
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        return $this->getSerializedBody($serializer);
    }

    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }

    protected function transformResponseBody(string $body, int $status, SerializerInterface $serializer, ?string $contentType = null): bool|RpcStatus|stdClass
    {
        if (200 === $status) {
            return json_decode($body);
        }
        return $serializer->deserialize($body, 'Chiphpotle\\Rest\\Model\\RpcStatus', 'json');
    }

    public function getAuthenticationScopes(): array
    {
        return [];
    }
}
