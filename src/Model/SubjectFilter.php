<?php

namespace Chiphpotle\Rest\Model;

class SubjectFilter
{

    protected ?string $subjectType = null;

    protected ?string $optionalSubjectId = null;

    protected ?SubjectFilterRelationFilter $optionalRelation = null;

    public static function createFromArray(array $subject)
    {
        $self = new self();
        $self->setSubjectType($subject[0])
            ->setOptionalSubjectId($subject[1] ?? null)
            ->setOptionalRelation($subject[2] ?? null);
        return $self;
    }

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

    public static function fromSubject(SubjectReference $subjectReference) : SubjectFilter
    {
        $filter = new self();
        $filter->setSubjectType($subjectReference->getObject()->getObjectType());
        $filter->setOptionalSubjectId($subjectReference->getObject()->getObjectId());
        $filter->setOptionalRelation($subjectReference->getOptionalRelation());
        return $filter;
    }

    public function __toString(): string
    {
        return (string)SubjectReference::create($this->subjectType, $this->optionalSubjectId, $this->optionalRelation?->getRelation());
    }


}