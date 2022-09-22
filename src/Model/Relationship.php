<?php

namespace Chiphpotle\Rest\Model;

class Relationship
{
    /**
     * ObjectReference is used to refer to a specific object in the system.
     */
    protected ?ObjectReference $resource;

    /**
     * relation is how the resource and subject are related.
     */
    protected ?string $relation;

    protected ?SubjectReference $subject;

    public function __construct(
        ?ObjectReference    $resource = null,
        ?string             $relation = null,
        ?SubjectReference $subject = null
    )
    {
        $this->resource = $resource;
        $this->relation = $relation;
        $this->subject = $subject;
    }


    public function getResource(): ?ObjectReference
    {
        return $this->resource;
    }

    public function setResource(?ObjectReference $resource): self
    {
        $this->resource = $resource;
        return $this;
    }

    public function getRelation(): ?string
    {
        return $this->relation;
    }

    public function setRelation(?string $relation): self
    {
        $this->relation = $relation;
        return $this;
    }

    public function getSubject(): ?SubjectReference
    {
        return $this->subject;
    }

    public function setSubject(?SubjectReference $subject): self
    {
        $this->subject = $subject;
        return $this;
    }
}