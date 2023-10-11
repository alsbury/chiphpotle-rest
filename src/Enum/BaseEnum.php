<?php

namespace Chiphpotle\Rest\Enum;

use Chiphpotle\Rest\Runtime\Normalizer\ValidationException;

abstract class BaseEnum
{
    /**
     * @return string[]
     */
    abstract public static function allowableValues(): array;

    public static function validate(string $value): void
    {
        if (!in_array($value, static::allowableValues())) {
            $class = get_called_class();
            $shortClass = substr($class, strrpos($class, '\\') + 1);
            throw new ValidationException("Invalid enum value for $shortClass");
        }
    }
}
