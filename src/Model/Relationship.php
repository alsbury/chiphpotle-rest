<?php

namespace Chiphpotle\Rest\Model;

/**
 * Relationship specifies how a resource relates to a subject. Relationships
 * form the data for the graph over which all permissions questions are
 * answered.
 */
class Relationship
{
    protected ?ObjectReference $resource;

    /**
     * relation is how the resource and subject are related.
     *
     * @var ?string
     */
    protected ?string $relation;

    protected ?SubjectReference $subject;

    protected ?ContextualizedCaveat $optionalCaveat;

    public function getResource(): ?ObjectReference
    {
        return $this->resource;
    }

    public function setResource(?ObjectReference $resource): self
    {
        $this->resource = $resource;
        return $this;
    }

    public function getRelation(): string
    {
        return $this->relation;
    }

    public function setRelation(string $relation): self
    {
        $this->relation = $relation;
        return $this;
    }

    public function getSubject(): SubjectReference
    {
        return $this->subject;
    }

    public function setSubject(SubjectReference $subject): self
    {
        $this->subject = $subject;
        return $this;
    }

    public function getOptionalCaveat(): ContextualizedCaveat
    {
        return $this->optionalCaveat;
    }

    public function setOptionalCaveat(ContextualizedCaveat $optionalCaveat): self
    {
        $this->optionalCaveat = $optionalCaveat;
        return $this;
    }
}
