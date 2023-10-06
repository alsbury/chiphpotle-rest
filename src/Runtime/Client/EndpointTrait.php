<?php

namespace Chiphpotle\Rest\Runtime\Client;

use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

trait EndpointTrait
{
    abstract protected function transformResponseBody(string $body, int $status, SerializerInterface $serializer, ?string $contentType = null);

    public function parseResponse(ResponseInterface $response, SerializerInterface $serializer, string $fetchMode = Client::FETCH_OBJECT)
    {
        $contentType = $response->hasHeader('Content-Type') ? current($response->getHeader('Content-Type')) : null;
        return $this->transformResponseBody((string) $response->getBody(), $response->getStatusCode(), $serializer, $contentType);
    }
}
