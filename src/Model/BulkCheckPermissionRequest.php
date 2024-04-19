<?php

namespace Chiphpotle\Rest\Model;

/**
 * @deprecated
 */
final class BulkCheckPermissionRequest
{
    /**
     * @param BulkCheckPermissionRequestItem[] $items
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
