<?php

namespace Chiphpotle\Rest\Model;

class RpcStatus
{
    protected ?int $code = null;

    protected ?string $message = null;

    /**
     * @var ProtobufAny[]
     */
    protected array $details = [];

    public function getCode(): ?int
    {
        return $this->code;
    }

    public function setCode(int $code): self
    {
        $this->code = $code;
        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;
        return $this;
    }

    public function getDetails(): array
    {
        return $this->details;
    }

    public function setDetails(array $details): self
    {
        $this->details = $details;
        return $this;
    }
}