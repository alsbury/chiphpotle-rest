<?php

namespace Chiphpotle\Rest\Model;

final class ExpandPermissionTreeResponse
{
    private ZedToken $expandedAt;

    private PermissionRelationshipTree $treeRoot;

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
