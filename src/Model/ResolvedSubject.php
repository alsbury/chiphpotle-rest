<?php

namespace Chiphpotle\Rest\Model;

class ResolvedSubject
{

    /**
    * subject_object_id is the Object ID of the subject found. May be a `*` if
    * a wildcard was found.
    *
    * @var ?string
    */
    protected ?string $subjectObjectId;

    protected string $permissionship = 'LOOKUP_PERMISSIONSHIP_UNSPECIFIED';

    protected ?PartialCaveatInfo $partialCaveatInfo;

    /**
    * subject_object_id is the Object ID of the subject found. May be a `*` if
    * a wildcard was found.
    *
    * @return string
    */
    public function getSubjectObjectId(): string
    {
        return $this->subjectObjectId;
    }

    /**
    * subject_object_id is the Object ID of the subject found. May be a `*` if
    * a wildcard was found.
    *
    * @param string $subjectObjectId
    *
    * @return self
    */
    public function setSubjectObjectId(string $subjectObjectId): self
    {
        $this->subjectObjectId = $subjectObjectId;
        return $this;
    }

    public function getPermissionship(): string
    {
        return $this->permissionship;
    }

    public function setPermissionship(string $permissionship): self
    {
        $this->permissionship = $permissionship;
        return $this;
    }

    public function getPartialCaveatInfo(): PartialCaveatInfo
    {
        return $this->partialCaveatInfo;
    }

    public function setPartialCaveatInfo(PartialCaveatInfo $partialCaveatInfo): self
    {
        $this->partialCaveatInfo = $partialCaveatInfo;
        return $this;
    }
}
