<?php

namespace Chiphpotle\Rest\Model;

use Chiphpotle\Rest\Enum\PreconditionOperation;

/**
 * Precondition specifies how and the existence or absence of certain relationships as expressed through the
 * accompanying filter should affect whether or not the operation proceeds.
 *
 * MUST_NOT_MATCH will fail the parent request if any relationships match the relationships filter.
 * MUST_MATCH will fail the parent request if there are no relationships that match the filter.
 */
final class Precondition
{
    protected PreconditionOperation $operation = PreconditionOperation::UNSPECIFIED;

    protected RelationshipFilter $filter;

    public function getOperation(): PreconditionOperation
    {
        return $this->operation;
    }

    public function setOperation(PreconditionOperation $operation): self
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
