<?php

namespace Chiphpotle\Rest\Model;

class BulkExportRelationshipsResponse
{
    protected Cursor $afterResultCursor;

    /**
     * @var Relationship[]
     */
    protected array $relationships;

    public function getAfterResultCursor(): Cursor
    {
        return $this->afterResultCursor;
    }

    public function setAfterResultCursor(Cursor $afterResultCursor): self
    {
        $this->afterResultCursor = $afterResultCursor;
        return $this;
    }

    /**
     * @return Relationship[]
     */
    public function getRelationships(): array
    {
        return $this->relationships;
    }

    /**
     * @param Relationship[] $relationships
     *
     * @return self
     */
    public function setRelationships(array $relationships): self
    {
        $this->relationships = $relationships;
        return $this;
    }
}
