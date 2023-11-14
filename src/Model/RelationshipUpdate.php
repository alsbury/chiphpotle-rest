<?php

namespace Chiphpotle\Rest\Model;

use Chiphpotle\Rest\Enum\UpdateOperation;

final class RelationshipUpdate implements \Stringable
{
    public function __construct(private UpdateOperation $operation, private Relationship $relationship)
    {
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
