<?php

namespace Chiphpotle\Rest\Endpoint;

use Chiphpotle\Rest\Model\LookupResourcesRequest;
use Chiphpotle\Rest\Model\PermissionsResourcesPostResponse200;
use Chiphpotle\Rest\Runtime\Client\BaseEndpoint;
use Chiphpotle\Rest\Runtime\Client\Endpoint as ClientEndpoint;
use Chiphpotle\Rest\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

final class PermissionsServiceLookupResources extends BaseEndpoint implements ClientEndpoint
{
    use EndpointTrait;

    /**
    * @param LookupResourcesRequest $body LookupResourcesRequest performs a lookup of all resources of a particular
    * kind on which the subject has the specified permission or the relation in
    * which the subject exists, streaming back the IDs of those resources.
    */
    public function __construct(LookupResourcesRequest $body)
    {
        $this->body = $body;
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getUri(): string
    {
        return '/v1/permissions/resources';
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        return $this->getSerializedBody($serializer);
    }

    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }

    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null): PermissionsResourcesPostResponse200
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (200 === $status) {
            return $serializer->deserialize($body, PermissionsResourcesPostResponse200::class, 'json');
        }
        $this->throwRpcException($body, $serializer);
    }

    public function getAuthenticationScopes(): array
    {
        return [];
    }
}
