<?php

namespace Chiphpotle\Rest\Model;

use Chiphpotle\Rest\Enum\LookupPermissionship;

/**
 * ResolvedSubject is a single subject resolved within LookupSubjects.
 */
final class ResolvedSubject
{
    /**
    * subject_object_id is the Object ID of the subject found. May be a `*` if
    * a wildcard was found.
    *
    * @var ?string
    */
    protected ?string $subjectObjectId;

    protected LookupPermissionship $permissionship = LookupPermissionship::UNSPECIFIED;

    protected ?PartialCaveatInfo $partialCaveatInfo;

    public function getSubjectObjectId(): string|null
    {
        return $this->subjectObjectId;
    }

    public function setSubjectObjectId(string $subjectObjectId): self
    {
        $this->subjectObjectId = $subjectObjectId;
        return $this;
    }

    public function getPermissionship(): LookupPermissionship
    {
        return $this->permissionship;
    }

    public function setPermissionship(LookupPermissionship $permissionship): self
    {
        $this->permissionship = $permissionship;
        return $this;
    }

    public function getPartialCaveatInfo(): ?PartialCaveatInfo
    {
        return $this->partialCaveatInfo;
    }

    public function setPartialCaveatInfo(PartialCaveatInfo $partialCaveatInfo): self
    {
        $this->partialCaveatInfo = $partialCaveatInfo;
        return $this;
    }
}
