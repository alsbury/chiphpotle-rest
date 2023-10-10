<?php

namespace Chiphpotle\Rest\Model;

final class BulkCheckPermissionResponse
{
    protected ZedToken $checkedAt;

    /**
     * @var BulkCheckPermissionPair[]
     */
    protected array $pairs;

    public function getCheckedAt(): ZedToken
    {
        return $this->checkedAt;
    }

    public function setCheckedAt(ZedToken $checkedAt): self
    {
        $this->checkedAt = $checkedAt;
        return $this;
    }

    /**
     * @return BulkCheckPermissionPair[]
     */
    public function getPairs(): array
    {
        return $this->pairs;
    }

    /**
     * @param BulkCheckPermissionPair[] $pairs
     *
     * @return self
     */
    public function setPairs(array $pairs): self
    {
        $this->pairs = $pairs;
        return $this;
    }
}
