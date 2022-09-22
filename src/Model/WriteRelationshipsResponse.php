<?php

namespace Chiphpotle\Rest\Model;

class WriteRelationshipsResponse
{
    /**
     * ZedToken is used to provide causality metadata between Write and Check
     * requests.
     *
     * See the authzed.api.v1.Consistency message for more information.
     */
    protected ZedToken $writtenAt;

    public function getWrittenAt(): ZedToken
    {
        return $this->writtenAt;
    }

    public function setWrittenAt(ZedToken $writtenAt): self
    {
        $this->writtenAt = $writtenAt;
        return $this;
    }
}