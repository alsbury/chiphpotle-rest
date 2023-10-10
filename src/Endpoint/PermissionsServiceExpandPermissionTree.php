<?php

namespace Chiphpotle\Rest\Endpoint;

use Chiphpotle\Rest\Model\ExpandPermissionTreeRequest;
use Chiphpotle\Rest\Model\ExpandPermissionTreeResponse;
use Chiphpotle\Rest\Runtime\Client\BaseEndpoint;
use Chiphpotle\Rest\Runtime\Client\Endpoint as ClientEndpoint;
use Chiphpotle\Rest\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

final class PermissionsServiceExpandPermissionTree extends BaseEndpoint implements ClientEndpoint
{
    use EndpointTrait;

    /**
    * @param ExpandPermissionTreeRequest $body ExpandPermissionTreeRequest returns a tree representing the expansion of all
    * relationships found accessible from a permission or relation on a particular
    * resource.
    *
    * ExpandPermissionTreeRequest is typically used to determine the full set of
    * subjects with a permission, along with the relationships that grant said
    * access.
    */
    public function __construct(ExpandPermissionTreeRequest $body)
    {
        $this->body = $body;
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getUri(): string
    {
        return '/v1/permissions/expand';
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        return $this->getSerializedBody($serializer);
    }

    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }

    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null): ExpandPermissionTreeResponse
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (200 === $status) {
            return $serializer->deserialize($body, ExpandPermissionTreeResponse::class, 'json');
        }
        $this->throwRpcException($body, $serializer);
    }

    public function getAuthenticationScopes(): array
    {
        return [];
    }
}
