<?php

namespace Chiphpotle\Rest\Model;

class LookupSubjectsResponse
{
    /**
     * ZedToken is used to provide causality metadata between Write and Check
     * requests.
     *
     * See the authzed.api.v1.Consistency message for more information.
     */
    protected ZedToken $lookedUpAt;

    /**
     * subject_object_id is the Object ID of the subject found. May be a `*` if
     * a wildcard was found.
     */
    protected string $subjectObjectId;

    /**
     * excluded_subject_ids are the Object IDs of the subjects excluded. This list
     * will only contain object IDs if `subject_object_id` is a wildcard (`*`) and
     * will only be populated if exclusions exist from the wildcard.
     *
     * @var string[]
     */
    protected array $excludedSubjectIds;

    protected string $permissionship = 'LOOKUP_PERMISSIONSHIP_UNSPECIFIED';

    protected ?PartialCaveatInfo $partialCaveatInfo;

    /**
     * ResolvedSubject is a single subject resolved within LookupSubjects.
     *
     * @var ?ResolvedSubject
     */
    protected ?ResolvedSubject $subject;

    /**
     * excluded_subjects are the subjects excluded. This list
     * will only contain subjects if `subject.subject_object_id` is a wildcard (`*`) and
     * will only be populated if exclusions exist from the wildcard.
     *
     * @var ResolvedSubject[]
     */
    protected ?array $excludedSubjects;

    /**
     * Cursor is used to provide resumption of listing between calls to APIs
     * such as LookupResources.
     *
     * @var ?Cursor
     */
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

    /**
     * ResolvedSubject is a single subject resolved within LookupSubjects.
     *
     * @return ResolvedSubject
     */
    public function getSubject(): ResolvedSubject
    {
        return $this->subject;
    }

    /**
     * ResolvedSubject is a single subject resolved within LookupSubjects.
     *
     * @param ResolvedSubject $subject
     *
     * @return self
     */
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
    * @return ResolvedSubject[]
    */
    public function getExcludedSubjects(): array
    {
        return $this->excludedSubjects;
    }

    /**
    * excluded_subjects are the subjects excluded. This list
    * will only contain subjects if `subject.subject_object_id` is a wildcard (`*`) and
    * will only be populated if exclusions exist from the wildcard.
    *
    * @param ResolvedSubject[] $excludedSubjects
    *
    * @return self
    */
    public function setExcludedSubjects(array $excludedSubjects): self
    {
        $this->excludedSubjects = $excludedSubjects;
        return $this;
    }

    /**
    * Cursor is used to provide resumption of listing between calls to APIs
    * such as LookupResources.
    *
    * @return Cursor
    */
    public function getAfterResultCursor(): Cursor
    {
        return $this->afterResultCursor;
    }

    /**
    * Cursor is used to provide resumption of listing between calls to APIs
    * such as LookupResources.
    *
    * @param Cursor $afterResultCursor
    *
    * @return self
    */
    public function setAfterResultCursor(Cursor $afterResultCursor): self
    {
        $this->afterResultCursor = $afterResultCursor;
        return $this;
    }
}
