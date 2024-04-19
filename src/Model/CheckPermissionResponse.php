<?php

namespace Chiphpotle\Rest\Model;

use Chiphpotle\Rest\Enum\Permissionship;

final class CheckPermissionResponse
{
    private ZedToken $checkedAt;

    private Permissionship $permissionship = Permissionship::UNSPECIFIED;

    private ?PartialCaveatInfo $partialCaveatInfo = null;

    public function getCheckedAt(): ZedToken
    {
        return $this->checkedAt;
    }

    public function setCheckedAt(ZedToken $checkedAt): self
    {
        $this->checkedAt = $checkedAt;
        return $this;
    }

    public function getPermissionship(): Permissionship
    {
        return $this->permissionship;
    }

    public function setPermissionship(Permissionship $permissionship): self
    {
        $this->permissionship = $permissionship;
        return $this;
    }

    public function getPartialCaveatInfo(): ?PartialCaveatInfo
    {
        return $this->partialCaveatInfo;
    }

    public function setPartialCaveatInfo(PartialCaveatInfo $partialCaveatInfo): self
    {
        $this->partialCaveatInfo = $partialCaveatInfo;
        return $this;
    }
}
