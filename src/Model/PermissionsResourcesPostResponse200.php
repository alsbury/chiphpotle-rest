<?php

namespace Chiphpotle\Rest\Model;

final class PermissionsResourcesPostResponse200
{
    /**
     * @var LookupResourcesResponse[]
     */
    protected array $result;

    protected ?RpcStatus $error;

    /**
     * @return LookupResourcesResponse[]
     */
    public function getResults(): array
    {
        return $this->result;
    }

    /**
     * @param LookupResourcesResponse[] $results
     */
    public function setResults(array $results): self
    {
        $this->result = $results;
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
