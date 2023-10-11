<?php

namespace Chiphpotle\Rest\Model;

final class Precondition
{
    protected string $operation = 'OPERATION_UNSPECIFIED';

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
