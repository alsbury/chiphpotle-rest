<?php

namespace Chiphpotle\Rest\Model;

/**
 * AlgebraicSubjectSet is a subject set which is computed based on applying the
 * specified operation to the operands according to the algebra of sets.
 *
 * UNION is a logical set containing the subject members from all operands.
 *
 * INTERSECTION is a logical set containing only the subject members which are
 * present in all operands.
 *
 * EXCLUSION is a logical set containing only the subject members which are
 * present in the first operand, and none of the other operands.
 */
final class AlgebraicSubjectSet
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
