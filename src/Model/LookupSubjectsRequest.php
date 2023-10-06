<?php

namespace Chiphpotle\Rest\Model;

class LookupSubjectsRequest
{
    /**
     * Consistency will define how a request is handled by the backend.
     * By defining a consistency requirement, and a token at which those
     * requirements should be applied, where applicable.
     */
    protected ?Consistency $consistency;

    /**
     * ObjectReference is used to refer to a specific object in the system.
     */
    protected ?ObjectReference $resource;

    /**
     * permission is the name of the permission (or relation) for which to find
     * the subjects.
     */
    protected ?string $permission;

    /**
     * subject_object_type is the type of subject object for which the IDs will
     * be returned.
     */
    protected ?string $subjectObjectType;

    /**
     * optional_subject_relation is the optional relation for the subject.
     */
    protected ?string $optionalSubjectRelation;

    public function __construct(
        ObjectReference $resource = null,
        string          $permission = null,
        string          $subjectObjectType = null,
        string          $optionalSubjectRelation = null,
        ?Consistency    $consistency = null
    ) {
        $this->resource = $resource;
        $this->consistency = $consistency;
        $this->permission = $permission;
        $this->subjectObjectType = $subjectObjectType;
        $this->optionalSubjectRelation = $optionalSubjectRelation;
    }

    public function getConsistency(): ?Consistency
    {
        return $this->consistency;
    }

    public function setConsistency(?Consistency $consistency): self
    {
        $this->consistency = $consistency;
        return $this;
    }

    public function getResource(): ?ObjectReference
    {
        return $this->resource;
    }

    public function setResource(?ObjectReference $resource): self
    {
        $this->resource = $resource;
        return $this;
    }

    public function getPermission(): ?string
    {
        return $this->permission;
    }

    public function setPermission(?string $permission): self
    {
        $this->permission = $permission;
        return $this;
    }

    public function getSubjectObjectType(): ?string
    {
        return $this->subjectObjectType;
    }

    public function setSubjectObjectType(?string $subjectObjectType): self
    {
        $this->subjectObjectType = $subjectObjectType;
        return $this;
    }

    public function getOptionalSubjectRelation(): ?string
    {
        return $this->optionalSubjectRelation;
    }

    public function setOptionalSubjectRelation(?string $optionalSubjectRelation): self
    {
        $this->optionalSubjectRelation = $optionalSubjectRelation;
        return $this;
    }
}
