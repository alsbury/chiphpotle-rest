<?php

namespace Chiphpotle\Rest\Model;

class CheckPermissionResponse
{
    /**
     * ZedToken is used to provide causality metadata between Write and Check
     * requests.
     *
     * See the authzed.api.v1.Consistency message for more information.
     */
    protected ZedToken $checkedAt;

    protected string $permissionship = 'PERMISSIONSHIP_UNSPECIFIED';

    public function getCheckedAt(): ZedToken
    {
        return $this->checkedAt;
    }

    public function setCheckedAt(ZedToken $checkedAt): self
    {
        $this->checkedAt = $checkedAt;
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

    public function __toString(): string
    {
        return $this->getPermissionship();
    }


}