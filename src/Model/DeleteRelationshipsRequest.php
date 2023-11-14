<?php

namespace Chiphpotle\Rest\Model;

/**
 * DeleteRelationshipsRequest $request DeleteRelationshipsRequest specifies which Relationships should be deleted,
 *  requesting the delete of *ALL* relationships that match the specified
 *  filters. If the optional_preconditions parameter is included, all of the
 *  specified preconditions must also be satisfied before the delete will be
 *  executed.
 */
final class DeleteRelationshipsRequest
{
    /**
     * @param Precondition[] $optionalPreconditions
     */
    public function __construct(private RelationshipFilter $relationshipFilter, private array $optionalPreconditions = [])
    {
    }

    public function getRelationshipFilter(): RelationshipFilter
    {
        return $this->relationshipFilter;
    }

    public function setRelationshipFilter(RelationshipFilter $relationshipFilter): self
    {
        $this->relationshipFilter = $relationshipFilter;
        return $this;
    }

    /**
     * @return Precondition[]
     */
    public function getOptionalPreconditions(): array
    {
        return $this->optionalPreconditions;
    }

    /**
     * @param Precondition[] $optionalPreconditions
     */
    public function setOptionalPreconditions(array $optionalPreconditions): self
    {
        $this->optionalPreconditions = $optionalPreconditions;
        return $this;
    }
}
