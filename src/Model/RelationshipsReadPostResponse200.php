<?php

namespace Chiphpotle\Rest\Model;

class RelationshipsReadPostResponse200
{
    /**
     * ReadRelationshipsResponse contains a Relationship found that matches the
     * specified relationship filter(s). A instance of this response message will
     * be streamed to the client for each relationship found.
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