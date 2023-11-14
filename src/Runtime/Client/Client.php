<?php

namespace Chiphpotle\Rest\Runtime\Client;

use Jane\Component\OpenApiRuntime\Client\Plugin\AuthenticationRegistry;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\StreamInterface;
use Symfony\Component\Serializer\SerializerInterface;

abstract class Client
{
    final public const FETCH_OBJECT = 'object';

    public function __construct(protected ClientInterface $httpClient, protected RequestFactoryInterface $requestFactory, protected SerializerInterface $serializer, protected StreamFactoryInterface $streamFactory)
    {
    }

    public function executeEndpoint(Endpoint $endpoint, string $fetch = self::FETCH_OBJECT): mixed
    {
        return $endpoint->parseResponse($this->processEndpoint($endpoint), $this->serializer, $fetch);
    }

    private function processEndpoint(Endpoint $endpoint): ResponseInterface
    {
        [$bodyHeaders, $body] = $endpoint->getBody($this->serializer, $this->streamFactory);
        $queryString = $endpoint->getQueryString();
        $uriGlue = !str_contains($endpoint->getUri(), '?') ? '?' : '&';
        $uri = $queryString !== '' ? $endpoint->getUri() . $uriGlue . $queryString : $endpoint->getUri();
        $request = $this->requestFactory->createRequest($endpoint->getMethod(), $uri);

        if ($body) {
            if ($body instanceof StreamInterface) {
                $request = $request->withBody($body);
            } elseif (is_resource($body)) {
                $request = $request->withBody($this->streamFactory->createStreamFromResource($body));
            } elseif (strlen((string) $body) <= 4000 && @file_exists($body)) { // more than 4096 chars will trigger an error
                $request = $request->withBody($this->streamFactory->createStreamFromFile($body));
            } else {
                $request = $request->withBody($this->streamFactory->createStream($body));
            }
        }

        foreach ($endpoint->getHeaders($bodyHeaders) as $name => $value) {
            $request = $request->withHeader($name, $value);
        }

        if (count($endpoint->getAuthenticationScopes()) > 0) {
            $scopes = [];
            foreach ($endpoint->getAuthenticationScopes() as $scope) {
                $scopes[] = $scope;
            }
            $request = $request->withHeader(AuthenticationRegistry::SCOPES_HEADER, $scopes);
        }

        return $this->httpClient->sendRequest($request);
    }
}
