<?php

namespace Chiphpotle\Rest\Endpoint;

use Chiphpotle\Rest\Model\LookupSubjectsRequest;
use Chiphpotle\Rest\Model\PermissionsSubjectsPostResponse200;
use Chiphpotle\Rest\Runtime\Client\BaseEndpoint;
use Chiphpotle\Rest\Runtime\Client\Endpoint as ClientEndpoint;
use Chiphpotle\Rest\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

final class PermissionsServiceLookupSubjects extends BaseEndpoint implements ClientEndpoint
{
    use EndpointTrait;

    /**
     * @param LookupSubjectsRequest $body LookupSubjectsRequest performs a lookup of all subjects of a particular
     * kind for which the subject has the specified permission or the relation in
     * which the subject exists, streaming back the IDs of those subjects.
     */
    public function __construct(LookupSubjectsRequest $body)
    {
        $this->body = $body;
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getUri(): string
    {
        return '/v1/permissions/subjects';
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        return $this->getSerializedBody($serializer);
    }

    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }

    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null): PermissionsSubjectsPostResponse200
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (200 === $status) {
            return $serializer->deserialize($body, PermissionsSubjectsPostResponse200::class, 'json');
        }
        $this->throwRpcException($body, $serializer);
    }

    public function getAuthenticationScopes(): array
    {
        return [];
    }
}
