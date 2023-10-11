<?php

namespace Chiphpotle\Rest\Enum;

/**
 * Permissionship communicates whether or not the subject has the requested permission or has a relationship with the
 * given resource, over the given relation.
 */
final class Permissionship extends BaseEnum
{
    public const UNSPECIFIED = 'PERMISSIONSHIP_UNSPECIFIED';

    public const NO_PERMISSION = 'PERMISSIONSHIP_NO_PERMISSION';

    public const HAS_PERMISSION = 'PERMISSIONSHIP_HAS_PERMISSION';

    public const CONDITIONAL_PERMISSION = 'PERMISSIONSHIP_CONDITIONAL_PERMISSION';

    public static function allowableValues(): array
    {
        return [
            self::NO_PERMISSION,
            self::HAS_PERMISSION,
            self::CONDITIONAL_PERMISSION
        ];
    }
}
