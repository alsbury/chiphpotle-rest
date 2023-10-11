<?php

namespace Chiphpotle\Rest\Model;

/**
 * ExpandPermissionTreeRequest returns a tree representing the expansion of all
 *  relationships found accessible from a permission or relation on a particular
 *  resource.
 *
 *  ExpandPermissionTreeRequest is typically used to determine the full set of
 *  subjects with a permission, along with the relationships that grant said
 *  access.
 */
final class ExpandPermissionTreeRequest
{
    protected ?Consistency $consistency;

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
