<?php

namespace Chiphpotle\Rest\Model;

class SubjectFilter
{

    protected ?string $subjectType = null;

    protected ?string $optionalSubjectId = null;

    protected ?SubjectFilterRelationFilter $optionalRelation = null;

    public function getSubjectType(): ?string
    {
        return $this->subjectType;
    }

    public function setSubjectType(?string $subjectType): SubjectFilter
    {
        $this->subjectType = $subjectType;
        return $this;
    }

    public function getOptionalSubjectId(): ?string
    {
        return $this->optionalSubjectId;
    }

    public function setOptionalSubjectId(?string $optionalSubjectId): SubjectFilter
    {
        $this->optionalSubjectId = $optionalSubjectId;
        return $this;
    }

    public function getOptionalRelation(): ?SubjectFilterRelationFilter
    {
        return $this->optionalRelation;
    }

    public function setOptionalRelation(?SubjectFilterRelationFilter $optionalRelation): SubjectFilter
    {
        $this->optionalRelation = $optionalRelation;
        return $this;
    }

}