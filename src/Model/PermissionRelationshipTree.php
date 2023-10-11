<?php

namespace Chiphpotle\Rest\Model;

/**
 * PermissionRelationshipTree is used for representing a tree of a resource and
 * its permission relationships with other objects.
 */
final class PermissionRelationshipTree
{
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
