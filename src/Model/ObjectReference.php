<?php

namespace Chiphpotle\Rest\Model;

class ObjectReference
{
    protected ?string $objectType;
    protected ?string $objectId;

    public function __construct(?string $objectType = null, ?string $objectId = null)
    {
        $this->objectType = $objectType;
        $this->objectId = $objectId;
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

    public function getObjectId(): string
    {
        return $this->objectId;
    }

    public function setObjectId(string $objectId): self
    {
        $this->objectId = $objectId;
        return $this;
    }
}