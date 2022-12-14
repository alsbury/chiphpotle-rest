<?php

namespace Chiphpotle\Rest\Model;

class WriteSchemaRequest
{

    /**
     * The Schema containing one or more Object Definitions that will be written
     * to the Permissions System.
     */
    protected string $schema;

    public function __construct(string $schema)
    {
        $this->schema = $schema;
    }

    public function getSchema(): string
    {
        return $this->schema;
    }

    public function setSchema(string $schema): self
    {
        $this->schema = $schema;
        return $this;
    }
}