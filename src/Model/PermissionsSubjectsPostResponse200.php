<?php

namespace Chiphpotle\Rest\Model;

class PermissionsSubjectsPostResponse200
{
    protected LookupSubjectsResponse $result;

    protected RpcStatus $error;

    public function getResult(): LookupSubjectsResponse
    {
        return $this->result;
    }

    public function setResult(LookupSubjectsResponse $result): self
    {
        $this->result = $result;
        return $this;
    }

    public function getError(): RpcStatus
    {
        return $this->error;
    }

    public function setError(RpcStatus $error): self
    {
        $this->error = $error;
        return $this;
    }
}
