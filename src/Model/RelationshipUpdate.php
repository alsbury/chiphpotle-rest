<?php

namespace Chiphpotle\Rest\Model;

use Chiphpotle\Rest\Enum\RelationshipUpdateOperation;

class RelationshipUpdate
{
    protected ?string $operation = "OPERATION_UNSPECIFIED";

    /**
     * Relationship specifies how a resource relates to a subject. Relationships
     * form the data for the graph over which all permissions questions are
     * answered.
     */
    protected ?Relationship $relationship;

    /**
     * @throws \Exception
     */
    public function __construct(
        ?string $operation = null,
        ?Relationship $relationship = null
    ) {
        if (
            !in_array(
                $operation,
                RelationshipUpdateOperation::getAllowableEnumValues()
            )
        ) {
            throw new \Exception("Invalid relationship update operation type");
        }
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

    public function __toString(): string
    {
        return '[' . $this->operation . ']' . ' ' . $this->relationship;
    }


}
