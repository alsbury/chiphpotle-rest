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

    /**
     * Create method will simplify the
     */
    public static function create(string $objectType, string $objectId, string $optionalRelation = null): self
    {
        return new self(new ObjectReference($objectType, $objectId), $optionalRelation);
    }

    public static function createFromArray(array $data)
    {
        return new self(new ObjectReference($data[0], $data[1]), $data[2] ?? null);
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

    public function toArray()
    {
        $arr = [$this->getObject()->getObjectType(), $this->getObject()->getObjectId()];
        if ($this->getOptionalRelation()) {
            $arr[2] = $this->getOptionalRelation();
        }
        return $arr;
    }

}