<?php

namespace Chiphpotle\Rest\Model;

/**
 * ObjectReference is used to refer to a specific object in the system.
 */
class ObjectReference
{
    protected ?string $objectType;

    protected ?string $objectId;

    public function __construct(?string $objectType = null, ?string $objectId = null)
    {
        $this->objectType = $objectType;
        $this->objectId = $objectId;
    }

    public static function create(string $objectType, string $objectId): ObjectReference
    {
        return new self($objectType, $objectId);
    }

    public static function createFromArray(array $data): self
    {
        return new self($data[0], $data[1]);
    }

    public function getObjectType(): string
    {
        return $this->objectType;
    }

    public function setObjectType(string $objectType): self
    {
        $this->objectType = $objectType;
        return $this;
    }

    public function getObjectId(): ?string
    {
        return $this->objectId;
    }

    public function setObjectId(string $objectId): self
    {
        $this->objectId = $objectId;
        return $this;
    }

    public function __toString(): string
    {
        return $this->getObjectType() . ($this->getObjectId() ? ':' . $this->getObjectId() : '');
    }

    public function toArray()
    {
        return [$this->getObjectType(), $this->getObjectId()];
    }
}
