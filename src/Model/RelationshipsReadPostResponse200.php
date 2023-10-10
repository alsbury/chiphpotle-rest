<?php

namespace Chiphpotle\Rest\Model;

final class RelationshipsReadPostResponse200
{
    /**
     * @var ReadRelationshipsResponse[]
     */
    protected ?array $result = null;

    protected ?RpcStatus $error = null;

    public function getResult(): ?array
    {
        return $this->result;
    }

    public function setResult(array $result): self
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
