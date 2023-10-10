<?php

namespace Chiphpotle\Rest\Model;

final class PermissionsResourcesPostResponse200
{
    protected LookupResourcesResponse $result;

    protected ?RpcStatus $error;

    public function getResult(): LookupResourcesResponse
    {
        return $this->result;
    }

    public function setResult(LookupResourcesResponse $result): self
    {
        $this->result = $result;
        return $this;
    }

    public function getError(): ?RpcStatus
    {
        return $this->error;
    }

    public function setError(RpcStatus $error): self
    {
        $this->error = $error;
        return $this;
    }
}
