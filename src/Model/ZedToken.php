<?php

namespace Chiphpotle\Rest\Model;

/**
 * ZedToken is used to provide causality metadata between Write and Check
 * requests.
 */
final class ZedToken
{
    protected string $token;

    public static function create(string $tokenInput): ZedToken
    {
        $token = new self();
        $token->setToken($tokenInput);
        return $token;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;
        return $this;
    }
}
