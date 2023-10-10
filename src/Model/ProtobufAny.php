<?php

namespace Chiphpotle\Rest\Model;

final class ProtobufAny extends \ArrayObject
{
    protected string $type;

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }
}
