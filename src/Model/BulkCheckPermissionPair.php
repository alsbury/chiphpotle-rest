<?php

namespace Chiphpotle\Rest\Model;

class BulkCheckPermissionPair
{
    protected BulkCheckPermissionRequestItem $request;

    protected BulkCheckPermissionResponseItem $item;

    protected ?RpcStatus $error;

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
