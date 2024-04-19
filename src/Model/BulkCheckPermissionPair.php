<?php

namespace Chiphpotle\Rest\Model;

final class BulkCheckPermissionPair
{
    private BulkCheckPermissionRequestItem $request;

    private BulkCheckPermissionResponseItem $item;

    private ?RpcStatus $error = null;

    public function getRequest(): BulkCheckPermissionRequestItem
    {
        return $this->request;
    }

    public function setRequest(BulkCheckPermissionRequestItem $request): self
    {
        $this->request = $request;
        return $this;
    }

    public function getItem(): BulkCheckPermissionResponseItem
    {
        return $this->item;
    }

    public function setItem(BulkCheckPermissionResponseItem $item): self
    {
        $this->item = $item;
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
