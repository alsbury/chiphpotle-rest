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
    protected RelationshipFilter $relationshipFilter;

    /**
     * @var Precondition[]
     */
    protected array $optionalPreconditions;

    /**
     * @param RelationshipFilter $relationshipFilter
     * @param array $optionalPreconditions
     */
    public function __construct(RelationshipFilter $relationshipFilter, array $optionalPreconditions = [])
    {
        $this->relationshipFilter = $relationshipFilter;
        $this->optionalPreconditions = $optionalPreconditions;
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
     *
     * @return self
     */
    public function setOptionalPreconditions(array $optionalPreconditions): self
    {
        $this->optionalPreconditions = $optionalPreconditions;
        return $this;
    }
}
