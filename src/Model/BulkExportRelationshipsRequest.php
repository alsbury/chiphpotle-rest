<?php

namespace Chiphpotle\Rest\Model;

final class BulkExportRelationshipsRequest
{
    public function __construct(private ?Consistency $consistency = null, private int $optionalLimit = 0,
                                private ?Cursor $optionalCursor = null)
    {
    }

    public function getConsistency(): ?Consistency
    {
        return $this->consistency;
    }

    public function setConsistency(Consistency $consistency): self
    {
        $this->consistency = $consistency;
        return $this;
    }

    public function getOptionalLimit(): int
    {
        return $this->optionalLimit;
    }

    public function setOptionalLimit(int $optionalLimit): self
    {
        $this->optionalLimit = $optionalLimit;
        return $this;
    }

    public function getOptionalCursor(): ?Cursor
    {
        return $this->optionalCursor;
    }

    public function setOptionalCursor(Cursor $optionalCursor): self
    {
        $this->optionalCursor = $optionalCursor;
        return $this;
    }
}
