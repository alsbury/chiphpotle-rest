<?php

namespace Chiphpotle\Rest\Model;

final class DeleteRelationshipsResponse
{
    /**
     * ZedToken is used to provide causality metadata between Write and Check
     * requests.
     *
     * See the authzed.api.v1.Consistency message for more information.
     */
    protected ZedToken $deletedAt;

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
