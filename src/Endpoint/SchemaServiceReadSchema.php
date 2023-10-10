<?php

namespace Chiphpotle\Rest\Endpoint;

use Chiphpotle\Rest\Model\ReadSchemaResponse;
use Chiphpotle\Rest\Runtime\Client\BaseEndpoint;
use Chiphpotle\Rest\Runtime\Client\Endpoint as ClientEndpoint;
use Chiphpotle\Rest\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

final class SchemaServiceReadSchema extends BaseEndpoint implements ClientEndpoint
{
    use EndpointTrait;

    /**
     * Errors include:
     * - INVALID_ARGUMENT: a provided value has failed to semantically validate
     * - NOT_FOUND: no schema has been defined
     */
    public function __construct()
    {
        $this->body = "{}";
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getUri(): string
    {
        return '/v1/schema/read';
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        return [[], $this->body];
    }

    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }

    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null): ReadSchemaResponse
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (200 === $status) {
            return $serializer->deserialize($body, ReadSchemaResponse::class, 'json');
        }
        $this->throwRpcException($body, $serializer);
    }

    public function getAuthenticationScopes(): array
    {
        return [];
    }
}
