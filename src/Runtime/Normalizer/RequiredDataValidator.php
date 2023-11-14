<?php

namespace Chiphpotle\Rest\Runtime\Normalizer;

trait RequiredDataValidator
{
    /**
     * If any of the required fields are empty, throw a ValidationException
     *
     * @param string[] $required
     * @return void
     */
    protected function checkRequired(array $data, array $required): void
    {
        $missing = array_filter($required, fn (string $field): bool => empty($data[$field]));
        if ($missing !== []) {
            throw new ValidationException('Missing required '.implode(', ', $missing));
        }
    }
}
