<?php

namespace Chiphpotle\Rest\Runtime\Client;

use Chiphpotle\Rest\Model\RpcStatus;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;

abstract class BaseEndpoint implements Endpoint
{
    protected array $queryParameters = [];

    protected array $headerParameters = [];

    protected mixed $body;

    abstract public function getMethod(): string;

    abstract public function getBody(SerializerInterface $serializer, $streamFactory = null): array;

    abstract public function getUri(): string;

    abstract public function getAuthenticationScopes(): array;

    abstract protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null);

    protected function getExtraHeaders(): array
    {
        return [];
    }

    public function getQueryString(): string
    {
        $optionsResolved = $this->getQueryOptionsResolver()->resolve($this->queryParameters);
        $optionsResolved = array_map(fn($value) => $value ?? '', $optionsResolved);
        return http_build_query($optionsResolved, '', '&', PHP_QUERY_RFC3986);
    }

    public function getHeaders(array $baseHeaders = []): array
    {
        return array_merge($this->getExtraHeaders(), $baseHeaders, $this->getHeadersOptionsResolver()->resolve($this->headerParameters));
    }

    protected function getQueryOptionsResolver(): OptionsResolver
    {
        return new OptionsResolver();
    }

    protected function getHeadersOptionsResolver(): OptionsResolver
    {
        return new OptionsResolver();
    }

    protected function getSerializedBody(SerializerInterface $serializer): array
    {
        return [['Content-Type' => ['application/json']], $serializer->serialize($this->body, 'json')];
    }

    protected function throwRpcException(string $body, SerializerInterface|DenormalizerInterface $serializer): void
    {
        $data = json_decode($body, true, 512, JSON_THROW_ON_ERROR);
        $rpcResponse = $serializer->denormalize($data['error'] ?? $data, RpcStatus::class, 'json');
        throw new RpcException($rpcResponse);
    }
}
