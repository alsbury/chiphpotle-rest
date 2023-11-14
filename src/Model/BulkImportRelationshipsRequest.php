<?php

namespace Chiphpotle\Rest\Model;

final class BulkImportRelationshipsRequest
{
    /**
     * @param Relationship[] $relationships
     */
    public function __construct(private array $relationships)
    {
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
