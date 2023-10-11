<?php

namespace Chiphpotle\Rest\Model;

/**
 * CheckPermissionRequest issues a check on whether a subject has a permission
 *  or is a member of a relation, on a specific resource.
 */
final class CheckPermissionRequest
{
    protected ?Consistency $consistency = null;

    protected ObjectReference $resource;

    /**
     * permission is the name of the permission (or relation) on which to execute
     * the check.
     */
    protected string $permission;

    protected SubjectReference $subject;

    protected mixed $context;

    public function __construct(
        ObjectReference  $resource,
        string           $permission,
        SubjectReference $subject,
        mixed            $context = null,
        ?Consistency     $consistency = null,
    ) {
        $this->subject = $subject;
        $this->permission = $permission;
        $this->resource = $resource;
        $this->context = $context;
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

    public function getContext(): mixed
    {
        return $this->context;
    }

    public function setContext(mixed $context): self
    {
        $this->context = $context;
        return $this;
    }

    public function __toString(): string
    {
        return $this->getResource() . '#' . $this->getPermission() . '@' . $this->getSubject();
    }
}
