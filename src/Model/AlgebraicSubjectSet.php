<?php

namespace Chiphpotle\Rest\Model;

class AlgebraicSubjectSet
{
    protected string $operation = 'OPERATION_UNSPECIFIED';

    /**
     * @var PermissionRelationshipTree[]
     */
    protected array $children;

    public function getOperation(): string
    {
        return $this->operation;
    }

    public function setOperation(string $operation): self
    {
        $this->operation = $operation;
        return $this;
    }

    /**
     * @return PermissionRelationshipTree[]
     */
    public function getChildren(): array
    {
        return $this->children;
    }

    /**
     * @param PermissionRelationshipTree[] $children
     *
     * @return self
     */
    public function setChildren(array $children): self
    {
        $this->children = $children;
        return $this;
    }
}