<?php

namespace Chiphpotle\Rest\Endpoint;

use Chiphpotle\Rest\Model\WriteSchemaRequest;
use Chiphpotle\Rest\Runtime\Client\BaseEndpoint;
use Chiphpotle\Rest\Runtime\Client\Endpoint as ClientEndpoint;
use Chiphpotle\Rest\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use stdClass;
use Symfony\Component\Serializer\SerializerInterface;

final class SchemaServiceWriteSchema extends BaseEndpoint implements ClientEndpoint
{
    use EndpointTrait;

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

    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null): stdClass
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (200 === $status) {
            return json_decode($body);
        }
        $this->throwRpcException($body, $serializer);
    }

    public function getAuthenticationScopes(): array
    {
        return [];
    }
}
