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
     * @var ?RelationshipUpdate[]
     */
    protected ?array $updates;

    /**
     * @var ?Precondition[]
     */
    protected ?array $optionalPreconditions;

    /**
     * @param RelationshipUpdate[] $updates
     * @param Precondition[] $optionalPreconditions
     */
    public function __construct(?array $updates = null, ?array $optionalPreconditions = null)
    {
        $this->updates = $updates;
        $this->optionalPreconditions = $optionalPreconditions;
    }

    /**
     * @return ?RelationshipUpdate[]
     */
    public function getUpdates(): ?array
    {
        return $this->updates;
    }

    /**
     * @param ?RelationshipUpdate[] $updates
     *
     * @return self
     */
    public function setUpdates(?array $updates): self
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
     *
     * @return self
     */
    public function setOptionalPreconditions(?array $optionalPreconditions): self
    {
        $this->optionalPreconditions = $optionalPreconditions;
        return $this;
    }
}
