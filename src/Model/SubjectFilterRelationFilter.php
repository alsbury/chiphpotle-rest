<?php

namespace Chiphpotle\Rest\Model;

final class SubjectFilterRelationFilter
{
    public function __construct(private ?string $relation)
    {
    }

    public static function create(string $relation): self
    {
        return new self($relation);
    }

    public function getRelation(): ?string
    {
        return $this->relation;
    }

    public function setRelation(?string $relation): self
    {
        $this->relation = $relation;
        return $this;
    }
}
