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
    public function __construct(
        private ObjectReference $resource,
        /**
         * permission is the name of the permission or relation over which to run the
         * expansion for the resource.
         */
        private string                  $permission,
        private ?Consistency $consistency = null
    ) {
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
