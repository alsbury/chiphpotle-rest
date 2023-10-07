<?php

namespace Chiphpotle\Rest\Model;

class WatchRequest
{
    /**
     * @var string[]
     */
    protected array $optionalObjectTypes;

    protected ZedToken $optionalStartCursor;

    /**
     * @return string[]
     */
    public function getOptionalObjectTypes(): array
    {
        return $this->optionalObjectTypes;
    }

    /**
     * @param string[] $optionalObjectTypes
     *
     * @return self
     */
    public function setOptionalObjectTypes(array $optionalObjectTypes): self
    {
        $this->optionalObjectTypes = $optionalObjectTypes;
        return $this;
    }

    public function getOptionalStartCursor(): ZedToken
    {
        return $this->optionalStartCursor;
    }

    public function setOptionalStartCursor(ZedToken $optionalStartCursor): self
    {
        $this->optionalStartCursor = $optionalStartCursor;
        return $this;
    }
}
