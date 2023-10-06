<?php

namespace Chiphpotle\Rest\Model;

class PartialCaveatInfo
{
    /**
     * @var string[]
     */
    protected $missingRequiredContext;

    /**
     * @return string[]
     */
    public function getMissingRequiredContext(): array
    {
        return $this->missingRequiredContext;
    }

    /**
     * @param string[] $missingRequiredContext
     *
     * @return self
     */
    public function setMissingRequiredContext(array $missingRequiredContext): self
    {
        $this->missingRequiredContext = $missingRequiredContext;
        return $this;
    }
}
