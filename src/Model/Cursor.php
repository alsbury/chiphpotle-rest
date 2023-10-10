<?php

namespace Chiphpotle\Rest\Model;

/**
 * Cursor is used to provide resumption of listing between calls to APIs
 * such as LookupResources.
 */
final class Cursor
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
