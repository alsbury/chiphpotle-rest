<?php

namespace Chiphpotle\Rest\Model;

final class PermissionsSubjectsPostResponse200
{
    /**
     * @var LookupSubjectsResponse[]
     */
    private array $result;

    private RpcStatus $error;

    /**
     * @return LookupSubjectsResponse[]
     */
    public function getResults(): array
    {
        return $this->result;
    }

    /**
     * @param LookupSubjectsResponse[] $result
     * @return $this
     */
    public function setResults(array $result): self
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
