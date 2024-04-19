<?php

namespace Chiphpotle\Rest\Model;

/**
 * ContextualizedCaveat represents a reference to a caveat to be used by caveated relationships.
 * The context consists of key-value pairs that will be injected at evaluation time.
 * The keys must match the arguments defined on the caveat in the schema.
 */
final class ContextualizedCaveat
{
    public function __construct(private string $caveatName, private ?array $context = null)
    {
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

    public function getContext(): ?array
    {
        return $this->context;
    }

    public function setContext(?array $context): self
    {
        $this->context = $context;
        return $this;
    }
}
