<?php

namespace Chiphpotle\Rest\Model;

final class DirectSubjectSet
{
    /**
     * @var SubjectReference[]
     */
    protected array $subjects;

    /**
     * @return SubjectReference[]
     */
    public function getSubjects(): array
    {
        return $this->subjects;
    }

    /**
     * @param SubjectReference[] $subjects
     *
     * @return self
     */
    public function setSubjects(array $subjects): self
    {
        $this->subjects = $subjects;
        return $this;
    }
}
