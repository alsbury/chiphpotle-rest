<?php

namespace Chiphpotle\Rest\Model;

class BulkImportRelationshipsResponse
{
    protected string $numLoaded;

    public function getNumLoaded(): string
    {
        return $this->numLoaded;
    }

    public function setNumLoaded(string $numLoaded): self
    {
        $this->numLoaded = $numLoaded;
        return $this;
    }
}
