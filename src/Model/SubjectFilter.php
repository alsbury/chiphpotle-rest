<?php

namespace Chiphpotle\Rest\Model;

class SubjectFilter
{

    protected string $subjectType;

    protected string $optionalSubjectId;

    protected SubjectFilterRelationFilter $optionalRelation;

    public function getSubjectType(): string
    {
        return $this->subjectType;
    }

    public function setSubjectType(string $subjectType): self
    {
        $this->subjectType = $subjectType;
        return $this;
    }

    public function getOptionalSubjectId(): string
    {
        return $this->optionalSubjectId;
    }

    public function setOptionalSubjectId(string $optionalSubjectId): self
    {
        $this->optionalSubjectId = $optionalSubjectId;
        return $this;
    }

    public function getOptionalRelation(): SubjectFilterRelationFilter
    {
        return $this->optionalRelation;
    }

    public function setOptionalRelation(SubjectFilterRelationFilter $optionalRelation): self
    {
        $this->optionalRelation = $optionalRelation;
        return $this;
    }
}