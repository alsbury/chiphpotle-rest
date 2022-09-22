<?php

namespace Chiphpotle\Rest\Model;

class RelationshipUpdate
{
    protected ?string $operation = 'OPERATION_UNSPECIFIED';

    /**
    * Relationship specifies how a resource relates to a subject. Relationships
    * form the data for the graph over which all permissions questions are
    * answered.
    */
    protected ?Relationship $relationship;

    public function __construct(?string $operation = null, ?Relationship $relationship = null)
    {
        $this->operation = $operation;
        $this->relationship = $relationship;
    }

    public function getOperation(): ?string
    {
        return $this->operation;
    }

    public function setOperation(?string $operation): self
    {
        $this->operation = $operation;
        return $this;
    }

    public function getRelationship(): ?Relationship
    {
        return $this->relationship;
    }

    public function setRelationship(?Relationship $relationship): self
    {
        $this->relationship = $relationship;
        return $this;
    }
}