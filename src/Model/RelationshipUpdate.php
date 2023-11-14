<?php

namespace Chiphpotle\Rest\Model;

use Chiphpotle\Rest\Enum\UpdateOperation;

final class RelationshipUpdate
{
    private UpdateOperation $operation = UpdateOperation::UNSPECIFIED;
    private Relationship $relationship;

    public function __construct(UpdateOperation $operation, Relationship $relationship)
    {
        $this->operation = $operation;
        $this->relationship = $relationship;
    }

    public function getOperation(): UpdateOperation
    {
        return $this->operation;
    }

    public function setOperation(UpdateOperation $operation): self
    {
        $this->operation = $operation;
        return $this;
    }

    public function getRelationship(): Relationship
    {
        return $this->relationship;
    }

    public function setRelationship(Relationship $relationship): self
    {
        $this->relationship = $relationship;
        return $this;
    }

    public function __toString(): string
    {
        return '[' . $this->operation->value . ']' . ' ' . $this->relationship;
    }
}
