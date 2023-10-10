<?php

namespace Chiphpotle\Rest\Model;

/**
 * Specifies one or more filters used to read matching
 * relationships within the system.
 */
final class ReadRelationshipsRequest
{

    protected ?Consistency $consistency = null;

    protected ?RelationshipFilter $relationshipFilter = null;

    public function getConsistency(): ?Consistency
    {
        return $this->consistency;
    }

    public function setConsistency(?Consistency $consistency): self
    {
        $this->consistency = $consistency;
        return $this;
    }

    public function getRelationshipFilter(): ?RelationshipFilter
    {
        return $this->relationshipFilter;
    }

    public function setRelationshipFilter(?RelationshipFilter $relationshipFilter): self
    {
        $this->relationshipFilter = $relationshipFilter;
        return $this;
    }
}
