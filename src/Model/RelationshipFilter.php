<?php

namespace Chiphpotle\Rest\Model;

class RelationshipFilter
{
    protected ?string $resourceType;

    protected ?string $optionalResourceId;

    protected ?string $optionalRelation;

    /**
    * SubjectFilter specifies a filter on the subject of a relationship.
    *
    * subject_type is required and all other fields are optional, and will not
    * impose any additional requirements if left unspecified.
    */
    protected ?SubjectFilter $optionalSubjectFilter;

    public function __construct(
        ?string $resourceType = null,
        ?string $optionalResourceId = null,
        ?string $optionalRelation = null,
        ?SubjectFilter $optionalSubjectFilter = null
    ) {
        $this->resourceType = $resourceType;
        $this->optionalResourceId = $optionalResourceId;
        $this->optionalRelation = $optionalRelation;
        $this->optionalSubjectFilter = $optionalSubjectFilter;
    }

    public function getResourceType(): ?string
    {
        return $this->resourceType;
    }

    public function setResourceType(?string $resourceType): self
    {
        $this->resourceType = $resourceType;
        return $this;
    }

    public function getOptionalResourceId(): ?string
    {
        return $this->optionalResourceId;
    }

    public function setOptionalResourceId(?string $optionalResourceId): self
    {
        $this->optionalResourceId = $optionalResourceId;
        return $this;
    }

    public function getOptionalRelation(): ?string
    {
        return $this->optionalRelation;
    }

    public function setOptionalRelation(?string $optionalRelation): self
    {
        $this->optionalRelation = $optionalRelation;
        return $this;
    }

    public function getOptionalSubjectFilter(): ?SubjectFilter
    {
        return $this->optionalSubjectFilter;
    }

    public function setOptionalSubjectFilter(?SubjectFilter $optionalSubjectFilter): self
    {
        $this->optionalSubjectFilter = $optionalSubjectFilter;
        return $this;
    }

    public function __toString(): string
    {
        return $this->resourceType . ($this->optionalResourceId ? ':' . $this->optionalResourceId : '') . ($this->optionalRelation ? '#' . $this->optionalRelation : '') . '@' . $this->optionalSubjectFilter;
    }
}
