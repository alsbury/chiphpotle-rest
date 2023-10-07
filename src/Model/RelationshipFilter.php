<?php

namespace Chiphpotle\Rest\Model;

/**
 * RelationshipFilter is a collection of filters which when applied to a
 * relationship will return relationships that have exactly matching fields.
 *
 * resource_type is required. All other fields are optional and if left
 * unspecified will not filter relationships.
 */
class RelationshipFilter
{
    protected ?string $resourceType;

    protected ?string $optionalResourceId;

    protected ?string $optionalRelation;

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
