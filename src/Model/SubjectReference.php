<?php

namespace Chiphpotle\Rest\Model;

class SubjectReference
{
    /**
     * ObjectReference is used to refer to a specific object in the system.
     */
    protected ?ObjectReference $object;

    protected ?string $optionalRelation = null;

    /**
     * @param ObjectReference|null $object
     * @param string|null $optionalRelation
     */
    public function __construct(?ObjectReference $object = null, ?string $optionalRelation = null)
    {
        $this->object = $object;
        $this->optionalRelation = $optionalRelation;
    }

    public function getObject(): ObjectReference
    {
        return $this->object;
    }

    public function setObject(ObjectReference $object): self
    {
        $this->object = $object;
        return $this;
    }

    public function getOptionalRelation(): ?string
    {
        return $this->optionalRelation;
    }

    public function setOptionalRelation(?string $optionalRelation): self
    {
        $this->optionalRelation = $optionalRelation;
        return $this;
    }
}