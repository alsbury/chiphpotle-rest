<?php

namespace Chiphpotle\Rest\Model;

class LookupResourcesRequest
{
    /**
     * Consistency will define how a request is handled by the backend.
     * By defining a consistency requirement, and a token at which those
     * requirements should be applied, where applicable.
     */
    protected ?Consistency $consistency;

    /**
     * resource_object_type is the type of resource object for which the IDs will
     * be returned.
     */
    protected ?string $resourceObjectType;

    /**
     * permission is the name of the permission or relation for which the subject
     * must Check.
     */
    protected ?string $permission;

    protected ?SubjectReference $subject;

    public function __construct(
        ?string           $resourceObjectType = null,
        ?string           $permission = null,
        ?SubjectReference $subject = null,
        ?Consistency      $consistency = null
    )
    {
        $this->consistency = $consistency;
        $this->resourceObjectType = $resourceObjectType;
        $this->permission = $permission;
        $this->subject = $subject;
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

    public function getResourceObjectType(): string
    {
        return $this->resourceObjectType;
    }

    public function setResourceObjectType(string $resourceObjectType): self
    {
        $this->resourceObjectType = $resourceObjectType;
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

    public function getSubject(): SubjectReference
    {
        return $this->subject;
    }

    public function setSubject(SubjectReference $subject): self
    {
        $this->subject = $subject;
        return $this;
    }
}