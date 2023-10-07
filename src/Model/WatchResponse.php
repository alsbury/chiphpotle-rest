<?php

namespace Chiphpotle\Rest\Model;


/**
 * WatchResponse contains all tuple modification events in ascending
 * timestamp order, from the requested start snapshot to a snapshot
 * encoded in the watch response. The client can use the snapshot to resume
 * watching where the previous watch response left off.
 */
class WatchResponse
{
    /**
     * @var RelationshipUpdate[]
     */
    protected array $updates;

    protected ZedToken $changesThrough;

    /**
     * @return RelationshipUpdate[]
     */
    public function getUpdates(): array
    {
        return $this->updates;
    }

    /**
     * @param RelationshipUpdate[] $updates
     *
     * @return self
     */
    public function setUpdates(array $updates): self
    {
        $this->updates = $updates;
        return $this;
    }

    public function getChangesThrough(): ZedToken
    {
        return $this->changesThrough;
    }

    public function setChangesThrough(ZedToken $changesThrough): self
    {
        $this->changesThrough = $changesThrough;
        return $this;
    }
}
