<?php

namespace Chiphpotle\Rest\Model;

/**
 * CheckBulkPermissionsRequest issues a check on whether a subject has permission or is a member of a relation on a specific resource for each item in the list.
 *
 * The ordering of the items in the response is maintained in the response.
 * Checks with the same subject/permission will automatically be batched for performance optimization.
 */
final class CheckBulkPermissionsRequest
{
    /**
     * @param CheckBulkPermissionsRequestItem[] $items
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
     * @return CheckBulkPermissionsRequestItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param CheckBulkPermissionsRequestItem[] $items
     */
    public function setItems(array $items): self
    {
        $this->items = $items;
        return $this;
    }
}
