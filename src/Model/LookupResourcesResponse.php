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

    protected $permissionship = 'LOOKUP_PERMISSIONSHIP_UNSPECIFIED';

    protected PartialCaveatInfo $partialCaveatInfo;

    /**
     * Cursor is used to provide resumption of listing between calls to APIs
     * such as LookupResources.
     *
     * @var Cursor
     */
    protected Cursor $afterResultCursor;

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

    public function getPermissionship(): string
    {
        return $this->permissionship;
    }

    public function setPermissionship(string $permissionship): self
    {
        $this->permissionship = $permissionship;
        return $this;
    }

    public function getPartialCaveatInfo(): PartialCaveatInfo
    {
        return $this->partialCaveatInfo;
    }

    public function setPartialCaveatInfo(PartialCaveatInfo $partialCaveatInfo): self
    {
        $this->partialCaveatInfo = $partialCaveatInfo;
        return $this;
    }

    /**
    * Cursor is used to provide resumption of listing between calls to APIs
    * such as LookupResources.
    *
    * @return Cursor
    */
    public function getAfterResultCursor(): Cursor
    {
        return $this->afterResultCursor;
    }

    /**
    * Cursor is used to provide resumption of listing between calls to APIs
    * such as LookupResources.
    *
    * @param Cursor $afterResultCursor
    *
    * @return self
    */
    public function setAfterResultCursor(Cursor $afterResultCursor): self
    {
        $this->afterResultCursor = $afterResultCursor;
        return $this;
    }
}
