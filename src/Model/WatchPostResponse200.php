<?php

namespace Chiphpotle\Rest\Model;

final class WatchPostResponse200
{
    private WatchResponse $result;

    private ?RpcStatus $error;

    public function getResult(): WatchResponse
    {
        return $this->result;
    }

    public function setResult(WatchResponse $result): self
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
