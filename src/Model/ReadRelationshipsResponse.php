<?php

namespace Chiphpotle\Rest\Model;

/**
 * ReadRelationshipsResponse contains a Relationship found that matches the
 * specified relationship filter(s). An instance of this response message will
 * be streamed to the client for each relationship found.
 */
class ReadRelationshipsResponse
{
    protected ZedToken $readAt;

    protected Relationship $relationship;

    protected Cursor $afterResultCursor;

    public function getReadAt(): ZedToken
    {
        return $this->readAt;
    }

    public function setReadAt(ZedToken $readAt): self
    {
        $this->readAt = $readAt;
        return $this;
    }

    public function getRelationship(): Relationship
    {
        return $this->relationship;
    }

    public function setRelationship(Relationship $relationship): self
    {
        $this->relationship = $relationship;
        return $this;
    }

    public function getAfterResultCursor(): Cursor
    {
        return $this->afterResultCursor;
    }

    public function setAfterResultCursor(Cursor $afterResultCursor): self
    {
        $this->afterResultCursor = $afterResultCursor;
        return $this;
    }
}
