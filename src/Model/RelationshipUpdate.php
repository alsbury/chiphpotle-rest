<?php

namespace Chiphpotle\Rest\Model;

use Chiphpotle\Rest\Enum\UpdateOperation;

final class RelationshipUpdate
{
    protected string $operation = UpdateOperation::UNSPECIFIED;
    protected Relationship $relationship;

    public function __construct(string $operation, Relationship $relationship)
    {
        UpdateOperation::validate($operation);
        $this->operation = $operation;
        $this->relationship = $relationship;
    }

    public function getOperation(): string
    {
        return $this->operation;
    }

    public function setOperation(string $operation): self
    {
        UpdateOperation::validate($operation);
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
        return '[' . $this->operation . ']' . ' ' . $this->relationship;
    }
}
