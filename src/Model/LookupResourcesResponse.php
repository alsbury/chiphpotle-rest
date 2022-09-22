<?php

namespace Chiphpotle\Rest\Model;

class LookupResourcesResponse
{
    /**
     * ZedToken is used to provide causality metadata between Write and Check
     * requests.
     *
     * See the authzed.api.v1.Consistency message for more information.
     */
    protected ZedToken $lookedUpAt;

    protected string $resourceObjectId;

    public function getLookedUpAt(): ZedToken
    {
        return $this->lookedUpAt;
    }

    public function setLookedUpAt(ZedToken $lookedUpAt): self
    {
        $this->lookedUpAt = $lookedUpAt;
        return $this;
    }

    public function getResourceObjectId(): string
    {
        return $this->resourceObjectId;
    }

    public function setResourceObjectId(string $resourceObjectId): self
    {
        $this->resourceObjectId = $resourceObjectId;
        return $this;
    }
}