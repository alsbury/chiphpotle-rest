<?php

namespace Chiphpotle\Rest\Enum;


final class AlgebraicOperation extends BaseEnum
{
    public const UNSPECIFIED = 'OPERATION_UNSPECIFIED';
    public const UNION = 'OPERATION_UNION';
    public const INTERSECTION = 'OPERATION_INTERSECTION';
    public const EXCLUSION = 'OPERATION_EXCLUSION';
    public static function allowableValues(): array
    {
        return [self::UNION, self::INTERSECTION, self::EXCLUSION];
    }
}
