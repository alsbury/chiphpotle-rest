<?php

namespace Chiphpotle\Rest\Enum;


final class LookupPermissionship extends BaseEnum
{
    public const UNSPECIFIED = 'LOOKUP_PERMISSIONSHIP_UNSPECIFIED';
    public const HAS_PERMISSION = 'LOOKUP_PERMISSIONSHIP_HAS_PERMISSION';
    public const CONDITIONAL_PERMISSION = 'LOOKUP_PERMISSIONSHIP_CONDITIONAL_PERMISSION';

    public static function allowableValues(): array
    {
        return [self::HAS_PERMISSION, self::CONDITIONAL_PERMISSION];
    }
}
