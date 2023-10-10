<?php

namespace Chiphpotle\Rest\Model;

final class BulkImportRelationshipsRequest
{
    /**
     * @var Relationship[]
     */
    protected array $relationships;

    /**
     * @param Relationship[] $relationships
     */
    public function __construct(array $relationships)
    {
        $this->relationships = $relationships;
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
