<?php

namespace Chiphpotle\Rest\Model;

/**
 * LookupResourcesResponse contains a single matching resource object ID for the
 * requested object type, permission, and subject.
 */
final class LookupResourcesResponse
{
    protected ZedToken $lookedUpAt;

    protected string $resourceObjectId;

    protected string $permissionship = 'LOOKUP_PERMISSIONSHIP_UNSPECIFIED';

    protected PartialCaveatInfo $partialCaveatInfo;

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
