<?php

namespace Chiphpotle\Rest\Endpoint;

use Chiphpotle\Rest\Model\RpcStatus;
use Chiphpotle\Rest\Model\DeleteRelationshipsRequest;
use Chiphpotle\Rest\Model\DeleteRelationshipsResponse;
use Chiphpotle\Rest\Runtime\Client\BaseEndpoint;
use Chiphpotle\Rest\Runtime\Client\Endpoint as ClientEndpoint;
use Chiphpotle\Rest\Runtime\Client\EndpointTrait;
use Symfony\Component\Serializer\SerializerInterface;

class PermissionsServiceDeleteRelationships extends BaseEndpoint implements ClientEndpoint
{
    use EndpointTrait;

    /**
    * @param DeleteRelationshipsRequest $body DeleteRelationshipsRequest specifies which Relationships should be deleted,
    * requesting the delete of *ALL* relationships that match the specified
    * filters. If the optional_preconditions parameter is included, all of the
    * specified preconditions must also be satisfied before the delete will be
    * executed.
    */
    public function __construct(DeleteRelationshipsRequest $body)
    {
        $this->body = $body;
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getUri(): string
    {
        return '/v1/relationships/delete';
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        return $this->getSerializedBody($serializer);
    }

    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }

    protected function transformResponseBody(string $body, int $status, SerializerInterface $serializer, ?string $contentType = null): RpcStatus|DeleteRelationshipsResponse|null
    {
        if (200 === $status) {
            return $serializer->deserialize($body, 'Chiphpotle\\Rest\\Model\\DeleteRelationshipsResponse', 'json');
        }
        return $serializer->deserialize($body, 'Chiphpotle\\Rest\\Model\\RpcStatus', 'json');
    }

    public function getAuthenticationScopes(): array
    {
        return [];
    }
}
