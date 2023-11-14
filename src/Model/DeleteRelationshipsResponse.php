<?php

namespace Chiphpotle\Rest\Model;

final class DeleteRelationshipsResponse
{
    private ZedToken $deletedAt;

    public function getDeletedAt(): ZedToken
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(ZedToken $deletedAt): self
    {
        $this->deletedAt = $deletedAt;
        return $this;
    }
}
