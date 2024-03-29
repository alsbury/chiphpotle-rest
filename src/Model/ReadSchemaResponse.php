<?php

namespace Chiphpotle\Rest\Model;

final class ReadSchemaResponse
{
    private string $schemaText;

    public function getSchemaText(): string
    {
        return $this->schemaText;
    }

    public function setSchemaText(string $schemaText): self
    {
        $this->schemaText = $schemaText;
        return $this;
    }
}
