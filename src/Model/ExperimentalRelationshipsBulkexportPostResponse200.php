<?php

namespace Chiphpotle\Rest\Model;

final class ExperimentalRelationshipsBulkexportPostResponse200
{
    protected BulkExportRelationshipsResponse $result;

    protected ?RpcStatus $error;

    public function getResult(): BulkExportRelationshipsResponse
    {
        return $this->result;
    }

    public function setResult(BulkExportRelationshipsResponse $result): self
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
