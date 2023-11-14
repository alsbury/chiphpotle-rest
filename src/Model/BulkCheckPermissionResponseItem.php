<?php

namespace Chiphpotle\Rest\Model;

use Chiphpotle\Rest\Enum\Permissionship;

final class BulkCheckPermissionResponseItem
{
    protected Permissionship $permissionship = Permissionship::UNSPECIFIED;

    protected PartialCaveatInfo $partialCaveatInfo;

    public function getPermissionship(): Permissionship
    {
        return $this->permissionship;
    }

    public function setPermissionship(Permissionship $permissionship): self
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
