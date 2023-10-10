<?php

namespace Chiphpotle\Rest\Model;

/**
 * ContextualizedCaveat represents a reference to a caveat to be used by caveated relationships.
 * The context consists of key-value pairs that will be injected at evaluation time.
 * The keys must match the arguments defined on the caveat in the schema.
 */
final class ContextualizedCaveat
{
    protected string $caveatName;

    protected mixed $context;

    public function __construct(string $caveatName, mixed $context = null)
    {
        $this->caveatName = $caveatName;
        $this->context = $context;
    }

    public function getCaveatName(): string
    {
        return $this->caveatName;
    }

    public function setCaveatName(string $caveatName): self
    {
        $this->caveatName = $caveatName;
        return $this;
    }

    public function getContext(): mixed
    {
        return $this->context;
    }

    public function setContext(mixed $context): self
    {
        $this->context = $context;
        return $this;
    }
}
