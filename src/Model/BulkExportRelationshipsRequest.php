<?php

namespace Chiphpotle\Rest\Model;

class BulkExportRelationshipsRequest
{
    protected ?Consistency $consistency;

    protected int $optionalLimit = 0;

    protected ?Cursor $optionalCursor;

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
