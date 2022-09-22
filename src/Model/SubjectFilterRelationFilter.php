<?php

namespace Chiphpotle\Rest\Model;

class SubjectFilterRelationFilter
{

    protected string $relation;

    public function getRelation(): string
    {
        return $this->relation;
    }

    public function setRelation(string $relation): self
    {
        $this->relation = $relation;
        return $this;
    }
}