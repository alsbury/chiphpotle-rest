<?php

namespace Chiphpotle\Rest\Model;

class ReadRelationshipsRequest
{
    /**
    * Consistency will define how a request is handled by the backend.
    * By defining a consistency requirement, and a token at which those
    * requirements should be applied, where applicable.
    */
    protected ?Consistency $consistency = null;

    /**
    * RelationshipFilter is a collection of filters which when applied to a
    * relationship will return relationships that have exactly matching fields.
    *
    * resource_type is required. All other fields are optional and if left
    * unspecified will not filter relationships.
    */
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