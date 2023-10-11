<?php

namespace Chiphpotle\Rest\Model;

final class SubjectReference
{
    protected ObjectReference $object;

    protected ?string $optionalRelation = null;

    /**
     * @param ObjectReference|null $object
     * @param string|null $optionalRelation
     */
    public function __construct(ObjectReference $object = null, ?string $optionalRelation = null)
    {
        $this->object = $object;
        $this->optionalRelation = $optionalRelation;
    }

    /**
     * Create method will simplify creation
     */
    public static function create(?string $objectType, ?string $objectId = null, ?string $optionalRelation = null): self
    {
        return new self(new ObjectReference($objectType, $objectId), $optionalRelation);
    }

    public function getObject(): ObjectReference|null
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

    public function __toString(): string
    {
        return $this->getObject() . ($this->getOptionalRelation() ? '#'. $this->getOptionalRelation() : '');
    }
}
