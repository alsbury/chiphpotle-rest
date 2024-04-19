<?php

namespace Chiphpotle\Rest\Endpoint;

use Chiphpotle\Rest\Model\CheckBulkPermissionsRequest;
use Chiphpotle\Rest\Model\CheckBulkPermissionsResponse;
use Chiphpotle\Rest\Runtime\Client\BaseEndpoint;
use Chiphpotle\Rest\Runtime\Client\Endpoint;
use Chiphpotle\Rest\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

final class PermissionsServiceCheckBulkPermissions extends BaseEndpoint implements Endpoint
{
    use EndpointTrait;

    public function __construct(CheckBulkPermissionsRequest $body)
    {
        $this->body = $body;
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getUri(): string
    {
        return '/v1/permissions/checkbulk';
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        return $this->getSerializedBody($serializer);
    }

    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }

    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null): CheckBulkPermissionsResponse
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (200 === $status) {
            return $serializer->deserialize($body, \Chiphpotle\Rest\Model\CheckBulkPermissionsResponse::class, 'json');
        }
        return $serializer->deserialize($body, \Chiphpotle\Rest\Model\RpcStatus::class, 'json');
    }

    public function getAuthenticationScopes(): array
    {
        return [];
    }
}
