<?php

namespace Chiphpotle\Rest\Model;

class BulkImportRelationshipsRequest
{
    /**
     * @var Relationship[]
     */
    protected array $relationships;

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
