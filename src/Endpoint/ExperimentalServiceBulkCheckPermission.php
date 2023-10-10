<?php

namespace Chiphpotle\Rest\Endpoint;

use Chiphpotle\Rest\Model\BulkCheckPermissionRequest;
use Chiphpotle\Rest\Model\BulkCheckPermissionResponse;
use Chiphpotle\Rest\Model\RpcStatus;
use Chiphpotle\Rest\Runtime\Client\BaseEndpoint;
use Chiphpotle\Rest\Runtime\Client\Endpoint;
use Chiphpotle\Rest\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

final class ExperimentalServiceBulkCheckPermission extends BaseEndpoint implements Endpoint
{
    use EndpointTrait;

    public function __construct(BulkCheckPermissionRequest $body)
    {
        $this->body = $body;
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getUri(): string
    {
        return '/v1/experimental/permissions/bulkcheckpermission';
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        return $this->getSerializedBody($serializer);
    }

    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }

    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null): BulkCheckPermissionResponse|RpcStatus
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (200 === $status) {
            return $serializer->deserialize($body, BulkCheckPermissionResponse::class, 'json');
        }
        return $serializer->deserialize($body, RpcStatus::class, 'json');
    }

    public function getAuthenticationScopes(): array
    {
        return [];
    }
}
