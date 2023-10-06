<?php

namespace Chiphpotle\Rest\Model;

class ExpandPermissionTreeRequest
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
     * permission is the name of the permission or relation over which to run the
     * expansion for the resource.
     */
    protected string $permission;

    public function __construct(
        ObjectReference $resource,
        string          $permission,
        ?Consistency    $consistency = null
    ) {
        $this->consistency = $consistency;
        $this->resource = $resource;
        $this->permission = $permission;
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
}
