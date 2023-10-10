<?php

namespace Chiphpotle\Rest\Model;

final class Precondition
{
    protected string $operation = 'OPERATION_UNSPECIFIED';

    /**
    * RelationshipFilter is a collection of filters which when applied to a
    * relationship will return relationships that have exactly matching fields.
    *
    * resource_type is required. All other fields are optional and if left
    * unspecified will not filter relationships.
    */
    protected RelationshipFilter $filter;

    public function getOperation(): string
    {
        return $this->operation;
    }

    public function setOperation(string $operation): self
    {
        $this->operation = $operation;
        return $this;
    }

    public function getFilter(): RelationshipFilter
    {
        return $this->filter;
    }

    public function setFilter(RelationshipFilter $filter): self
    {
        $this->filter = $filter;
        return $this;
    }
}
