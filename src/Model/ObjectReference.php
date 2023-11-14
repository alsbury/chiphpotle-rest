<?php

namespace Chiphpotle\Rest\Model;

/**
 * ObjectReference is used to refer to a specific object in the system.
 */
final class ObjectReference
{
    public function __construct(private string $objectType, private ?string $objectId = null)
    {
    }

    public static function create(string $objectType, string $objectId): ObjectReference
    {
        return new self($objectType, $objectId);
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
}
