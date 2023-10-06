<?php

namespace Chiphpotle\Rest\Authentication;

use Jane\Component\OpenApiRuntime\Client\AuthenticationPlugin;
use Psr\Http\Message\RequestInterface;

class ApiKeyAuthAuthentication implements AuthenticationPlugin
{
    private string $apiKey;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function authentication(RequestInterface $request): RequestInterface
    {
        return $request->withHeader('Authorization', 'Bearer ' . $this->apiKey);
    }

    public function getScope(): string
    {
        return 'ApiKeyAuth';
    }
}
