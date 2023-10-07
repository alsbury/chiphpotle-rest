<?php

namespace Chiphpotle\Rest\Model;

class BulkCheckPermissionRequest
{
    protected ?Consistency $consistency;

    /**
     * @var BulkCheckPermissionRequestItem[]
     */
    protected array $items;

    public function getConsistency(): ?Consistency
    {
        return $this->consistency;
    }

    public function setConsistency(Consistency $consistency): self
    {
        $this->consistency = $consistency;
        return $this;
    }

    /**
     * @return BulkCheckPermissionRequestItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param BulkCheckPermissionRequestItem[] $items
     *
     * @return self
     */
    public function setItems(array $items): self
    {
        $this->items = $items;
        return $this;
    }
}