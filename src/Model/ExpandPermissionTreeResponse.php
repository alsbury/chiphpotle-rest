<?php

namespace Chiphpotle\Rest\Model;

class ExpandPermissionTreeResponse
{
    /**
     * ZedToken is used to provide causality metadata between Write and Check
     * requests.
     *
     * See the authzed.api.v1.Consistency message for more information.
     */
    protected ZedToken $expandedAt;

    /**
     * PermissionRelationshipTree is used for representing a tree of a resource and
     * its permission relationships with other objects.
     */
    protected PermissionRelationshipTree $treeRoot;

    public function getExpandedAt(): ZedToken
    {
        return $this->expandedAt;
    }

    public function setExpandedAt(ZedToken $expandedAt): self
    {
        $this->expandedAt = $expandedAt;
        return $this;
    }

    public function getTreeRoot(): PermissionRelationshipTree
    {
        return $this->treeRoot;
    }

    public function setTreeRoot(PermissionRelationshipTree $treeRoot): self
    {
        $this->treeRoot = $treeRoot;
        return $this;
    }
}
