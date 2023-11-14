<?php

namespace Chiphpotle\Rest\Model;

/**
 * LookupSubjectsRequest performs a lookup of all subjects of a particular
 *  kind for which the subject has the specified permission or the relation in
 *  which the subject exists, streaming back the IDs of those subjects.
 */
final class LookupSubjectsRequest
{
    /**
     * permission is the name of the permission (or relation) for which to find
     * the subjects.
     */
    private string $permission;

    /**
     * subject_object_type is the type of subject object for which the IDs will
     * be returned.
     */
    private string $subjectObjectType;

    /**
     * optional_subject_relation is the optional relation for the subject.
     */
    protected ?string $optionalSubjectRelation;

    public function __construct(
        private ObjectReference $resource,
        string                  $permission,
        string                  $subjectObjectType,
        ?string                 $optionalSubjectRelation = null,
        private ?Consistency $consistency = null
    ) {
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

    public function getResource(): ObjectReference
    {
        return $this->resource;
    }

    public function setResource(ObjectReference $resource): self
    {
        $this->resource = $resource;
        return $this;
    }

    public function getPermission(): string
    {
        return $this->permission;
    }

    public function setPermission(string $permission): self
    {
        $this->permission = $permission;
        return $this;
    }

    public function getSubjectObjectType(): string
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
