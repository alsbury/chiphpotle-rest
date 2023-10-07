<?php

namespace Chiphpotle\Rest\Model;

class BulkCheckPermissionRequestItem
{
    protected ObjectReference $resource;

    protected string $permission;

    protected SubjectReference $subject;

    protected mixed $context;

    public function __construct(ObjectReference $resource, string $permission, SubjectReference $subject, mixed $context = null)
    {
        $this->resource = $resource;
        $this->permission = $permission;
        $this->subject = $subject;
        $this->context = $context;
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

    public function getContext(): mixed
    {
        return $this->context;
    }

    public function setContext($context): self
    {
        $this->context = $context;
        return $this;
    }
}
