<?php

namespace Chiphpotle\Rest\Model;

use Chiphpotle\Rest\Enum\CheckPermissionResponsePermissionship;

final class BulkCheckPermissionResponseItem
{
    protected string $permissionship = CheckPermissionResponsePermissionship::UNSPECIFIED;

    protected PartialCaveatInfo $partialCaveatInfo;

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
}
