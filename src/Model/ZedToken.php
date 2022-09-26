<?php

namespace Chiphpotle\Rest\Model;

class ZedToken
{

    protected string $token;

    /**
     * @param string $tokenInput
     * @return ZedToken
     */
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