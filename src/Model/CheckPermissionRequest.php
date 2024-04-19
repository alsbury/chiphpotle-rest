<?php

namespace Chiphpotle\Rest\Model;

/**
 * CheckPermissionRequest issues a check on whether a subject has a permission
 *  or is a member of a relation, on a specific resource.
 */
final class CheckPermissionRequest implements \Stringable
{
    public function __construct(
        private ObjectReference  $resource,
        private string           $permission,
        private SubjectReference $subject,
        private ?array            $context = null,
        private ?Consistency     $consistency = null,
    ) {
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

    public function getContext(): ?array
    {
        return $this->context;
    }

    public function setContext(?array $context): self
    {
        $this->context = $context;
        return $this;
    }

    public function __toString(): string
    {
        return $this->getResource() . '#' . $this->getPermission() . '@' . $this->getSubject();
    }
}
