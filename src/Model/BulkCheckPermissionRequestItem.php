<?php

namespace Chiphpotle\Rest\Model;

final class BulkCheckPermissionRequestItem
{
    public function __construct(
        private ObjectReference $resource,
        private string $permission,
        private SubjectReference $subject,
        private mixed $context = null
    ) {
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

    public function setContext(mixed $context): self
    {
        $this->context = $context;
        return $this;
    }
}
