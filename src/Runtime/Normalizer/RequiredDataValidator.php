<?php

namespace Chiphpotle\Rest\Runtime\Normalizer;

trait RequiredDataValidator
{
    /**
     * If any of the required fields are empty, throw a ValidationException
     *
     * @param array $data
     * @param string[] $required
     * @return void
     */
    protected function checkRequired(array $data, array $required): void
    {
        $missing = array_filter($required, fn (string $field) => empty($data[$field]));
        if (!empty($missing)) {
            throw new ValidationException('Missing required '.implode(', ', $missing));
        }
    }
}
