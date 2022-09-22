<?php

namespace Chiphpotle\Rest\Model;

class CheckPermissionRequest
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
    protected ObjectReference $resource;

    /**
     * permission is the name of the permission (or relation) on which to execute
     * the check.
     */
    protected string $permission;

    protected SubjectReference $subject;

    public function __construct(
        SubjectReference $subject,
        string           $permission,
        ObjectReference  $resource,
        ?Consistency     $consistency = null,
    )
    {
        $this->subject = $subject;
        $this->permission = $permission;
        $this->resource = $resource;
        $this->consistency = $consistency;
    }


    public function getConsistency(): ?Consistency
    {
        return $this->consistency;
    }

    public function setConsistency(Consistency $consistency): self
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