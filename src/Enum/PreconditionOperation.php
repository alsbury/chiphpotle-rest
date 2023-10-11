<?php

namespace Chiphpotle\Rest\Enum;

final class PreconditionOperation extends BaseEnum
{
    public const UNSPECIFIED = 'OPERATION_UNSPECIFIED';
    public const MUST_MATCH = 'OPERATION_MUST_MATCH';
    public const MUST_NOT_MATCH = 'OPERATION_MUST_NOT_MATCH';

    public static function allowableValues(): array
    {
        return [self::MUST_MATCH, self::MUST_NOT_MATCH];
    }
}
