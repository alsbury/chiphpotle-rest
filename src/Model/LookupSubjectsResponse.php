<?php

namespace Chiphpotle\Rest\Model;

use Chiphpotle\Rest\Enum\LookupPermissionship;

/**
 * LookupSubjectsResponse contains a single matching subject object ID for the
 * requested subject object type on the permission or relation.
 */
final class LookupSubjectsResponse
{
    protected ZedToken $lookedUpAt;

    /**
     * subject_object_id is the Object ID of the subject found. May be a `*` if
     * a wildcard was found.
     */
    protected string $subjectObjectId;

    protected array $excludedSubjectIds;

    protected string $permissionship = LookupPermissionship::UNSPECIFIED;

    protected ?PartialCaveatInfo $partialCaveatInfo;

    protected ?ResolvedSubject $subject;

    /**
     * excluded_subjects are the subjects excluded. This list
     * will only contain subjects if `subject.subject_object_id` is a wildcard (`*`) and
     * will only be populated if exclusions exist from the wildcard.
     *
     * @var ResolvedSubject[]
     */
    protected ?array $excludedSubjects;

    protected ?Cursor $afterResultCursor;

    public function getLookedUpAt(): ZedToken
    {
        return $this->lookedUpAt;
    }

    public function setLookedUpAt(ZedToken $lookedUpAt): self
    {
        $this->lookedUpAt = $lookedUpAt;
        return $this;
    }

    public function getSubjectObjectId(): string
    {
        return $this->subjectObjectId;
    }

    public function setSubjectObjectId(string $subjectObjectId): self
    {
        $this->subjectObjectId = $subjectObjectId;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getExcludedSubjectIds(): array
    {
        return $this->excludedSubjectIds;
    }

    /**
     * @param string[] $excludedSubjectIds
     *
     * @return self
     */
    public function setExcludedSubjectIds(array $excludedSubjectIds): self
    {
        $this->excludedSubjectIds = $excludedSubjectIds;
        return $this;
    }

    public function getPermissionship(): string
    {
        return $this->permissionship;
    }

    public function setPermissionship(string $permissionship): self
    {
        LookupPermissionship::validate($permissionship);
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

    public function getSubject(): ResolvedSubject|null
    {
        return $this->subject;
    }

    public function setSubject(ResolvedSubject $subject): self
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * excluded_subjects are the subjects excluded. This list
     * will only contain subjects if `subject.subject_object_id` is a wildcard (`*`) and
     * will only be populated if exclusions exist from the wildcard.
     *
     * @return ResolvedSubject[]|null
     */
    public function getExcludedSubjects(): ?array
    {
        return $this->excludedSubjects;
    }

    public function setExcludedSubjects(array $excludedSubjects): self
    {
        $this->excludedSubjects = $excludedSubjects;
        return $this;
    }

    public function getAfterResultCursor(): Cursor|null
    {
        return $this->afterResultCursor;
    }

    public function setAfterResultCursor(Cursor $afterResultCursor): self
    {
        $this->afterResultCursor = $afterResultCursor;
        return $this;
    }
}
