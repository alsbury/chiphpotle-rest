<?php

namespace Chiphpotle\Rest\Model;

/**
 * SubjectReference is used for referring to the subject portion of a Relationship. The relation component is optional
 * and is used for defining a sub-relation on the subject, e.g. group:123#members
 */
final class SubjectReference implements \Stringable
{
    public function __construct(private ObjectReference $object, private ?string $optionalRelation = null)
    {
    }

    /**
     * Create method will simplify creation
     */
    public static function create(string $objectType, ?string $objectId = null, ?string $optionalRelation = null): self
    {
        return new self(new ObjectReference($objectType, $objectId), $optionalRelation);
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

    public function __toString(): string
    {
        return $this->getObject() . ($this->getOptionalRelation() ? '#'. $this->getOptionalRelation() : '');
    }
}
