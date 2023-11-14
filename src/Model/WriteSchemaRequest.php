<?php

namespace Chiphpotle\Rest\Model;

/**
 * WriteSchemaRequest is the required data used to "upsert" the Schema of a
 * Permissions System.
 */
final class WriteSchemaRequest
{
    /**
     * @param string $schema The Schema containing one or more Object Definitions that will be written to the Permissions System.
     */
    public function __construct(private string $schema)
    {
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
