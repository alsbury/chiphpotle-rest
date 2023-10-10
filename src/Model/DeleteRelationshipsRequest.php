<?php

namespace Chiphpotle\Rest\Model;

final class DeleteRelationshipsRequest
{
    /**
     * RelationshipFilter is a collection of filters which when applied to a
     * relationship will return relationships that have exactly matching fields.
     *
     * resource_type is required. All other fields are optional and if left
     * unspecified will not filter relationships.
     */
    protected RelationshipFilter $relationshipFilter;

    /**
     * @var Precondition[]
     */
    protected array $optionalPreconditions;

    /**
     * RelationshipFilter is a collection of filters which when applied to a
     * relationship will return relationships that have exactly matching fields.
     *
     * resource_type is required. All other fields are optional and if left
     * unspecified will not filter relationships.
     */
    public function getRelationshipFilter(): RelationshipFilter
    {
        return $this->relationshipFilter;
    }

    /**
     * RelationshipFilter is a collection of filters which when applied to a
     * relationship will return relationships that have exactly matching fields.
     *
     * resource_type is required. All other fields are optional and if left
     * unspecified will not filter relationships.
     */
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
