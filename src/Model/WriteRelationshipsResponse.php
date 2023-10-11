<?php

namespace Chiphpotle\Rest\Model;

final class WriteRelationshipsResponse
{
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
