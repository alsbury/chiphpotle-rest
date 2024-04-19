<?php

namespace Chiphpotle\Rest\Model;

final class CheckBulkPermissionsResponse
{
    protected ZedToken $checkedAt;

    /**
     * @var CheckBulkPermissionsPair[]
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
     * @return CheckBulkPermissionsPair[]
     */
    public function getPairs(): array
    {
        return $this->pairs;
    }

    /**
     * @param CheckBulkPermissionsPair[] $pairs
     */
    public function setPairs(array $pairs): self
    {
        $this->pairs = $pairs;
        return $this;
    }
}
