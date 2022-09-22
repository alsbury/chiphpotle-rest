<?php

namespace Chiphpotle\Rest\Model;

class ZedToken
{

    protected string $token;

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