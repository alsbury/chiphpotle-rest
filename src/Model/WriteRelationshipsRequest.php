<?php

namespace Chiphpotle\Rest\Model;

/**
 * WriteRelationshipsRequest contains a list of Relationship mutations that
 * should be applied to the service. If the optional_preconditions parameter
 * is included, all of the specified preconditions must also be satisfied before
 * the write will be committed.
 */
final class WriteRelationshipsRequest
{
    /**
     * @param RelationshipUpdate[] $updates
     * @param Precondition[] $optionalPreconditions
     */
    public function __construct(private array $updates, private ?array $optionalPreconditions = null)
    {
    }

    /**
     * @return RelationshipUpdate[]
     */
    public function getUpdates(): array
    {
        return $this->updates;
    }

    /**
     * @param RelationshipUpdate[] $updates
     */
    public function setUpdates(array $updates): self
    {
        $this->updates = $updates;
        return $this;
    }

    /**
     * @return ?Precondition[]
     */
    public function getOptionalPreconditions(): ?array
    {
        return $this->optionalPreconditions;
    }

    /**
     * @param Precondition[] $optionalPreconditions
     */
    public function setOptionalPreconditions(?array $optionalPreconditions): self
    {
        $this->optionalPreconditions = $optionalPreconditions;
        return $this;
    }
}
