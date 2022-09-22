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
}