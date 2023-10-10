<?php

namespace Chiphpotle\Rest\Model;

final class PermissionRelationshipTree
{
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
    protected AlgebraicSubjectSet $intermediate;

    /**
     * DirectSubjectSet is a subject set which is simply a collection of subjects.
     */
    protected DirectSubjectSet $leaf;

    /**
     * ObjectReference is used to refer to a specific object in the system.
     */
    protected ObjectReference $expandedObject;

    protected string $expandedRelation;

    public function getIntermediate(): AlgebraicSubjectSet
    {
        return $this->intermediate;
    }

    public function setIntermediate(AlgebraicSubjectSet $intermediate): self
    {
        $this->intermediate = $intermediate;
        return $this;
    }

    public function getLeaf(): DirectSubjectSet
    {
        return $this->leaf;
    }

    public function setLeaf(DirectSubjectSet $leaf): self
    {
        $this->leaf = $leaf;
        return $this;
    }

    public function getExpandedObject(): ObjectReference
    {
        return $this->expandedObject;
    }

    public function setExpandedObject(ObjectReference $expandedObject): self
    {
        $this->expandedObject = $expandedObject;
        return $this;
    }

    public function getExpandedRelation(): string
    {
        return $this->expandedRelation;
    }

    public function setExpandedRelation(string $expandedRelation): self
    {
        $this->expandedRelation = $expandedRelation;
        return $this;
    }
}
