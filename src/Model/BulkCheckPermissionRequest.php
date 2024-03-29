<?php

namespace Chiphpotle\Rest\Model;

final class BulkCheckPermissionRequest
{
    /**
     * @param BulkCheckPermissionRequestItem[] $items
     * @param Consistency|null $consistency
     */
    public function __construct(private array $items, private ?Consistency $consistency = null)
    {
    }

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
