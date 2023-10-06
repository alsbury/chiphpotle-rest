<?php

namespace Chiphpotle\Rest\Model;

class ReadRelationshipsResponse
{
    /**
    * ZedToken is used to provide causality metadata between Write and Check
    * requests.
    *
    * See the authzed.api.v1.Consistency message for more information.
    *
    * @var ZedToken
    */
    protected ZedToken $readAt;

    /**
    * Relationship specifies how a resource relates to a subject. Relationships
    * form the data for the graph over which all permissions questions are
    * answered.
    */
    protected Relationship $relationship;

    public function getReadAt(): ZedToken
    {
        return $this->readAt;
    }

    public function setReadAt(ZedToken $readAt): self
    {
        $this->readAt = $readAt;
        return $this;
    }

    public function getRelationship(): Relationship
    {
        return $this->relationship;
    }

    public function setRelationship(Relationship $relationship): self
    {
        $this->relationship = $relationship;
        return $this;
    }
}
