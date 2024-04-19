<?php

namespace Chiphpotle\Rest\Model;

final class CheckBulkPermissionsPair
{

    protected CheckBulkPermissionsRequestItem $request;

    protected CheckBulkPermissionsResponseItem $item;

    protected ?RpcStatus $error = null;

    public function getRequest(): CheckBulkPermissionsRequestItem
    {
        return $this->request;
    }

    public function setRequest(CheckBulkPermissionsRequestItem $request): self
    {
        $this->request = $request;
        return $this;
    }

    public function getItem(): CheckBulkPermissionsResponseItem
    {
        return $this->item;
    }

    public function setItem(CheckBulkPermissionsResponseItem $item): self
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
