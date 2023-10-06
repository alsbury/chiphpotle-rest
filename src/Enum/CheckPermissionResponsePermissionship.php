<?php

namespace Chiphpotle\Rest\Enum;

class CheckPermissionResponsePermissionship
{
    public const UNSPECIFIED = 'PERMISSIONSHIP_UNSPECIFIED';

    public const NO_PERMISSION = 'PERMISSIONSHIP_NO_PERMISSION';

    public const HAS_PERMISSION = 'PERMISSIONSHIP_HAS_PERMISSION';

    /**
     * @return string[]
     */
    public static function getAllowableEnumValues(): array
    {
        return [
            self::UNSPECIFIED,
            self::NO_PERMISSION,
            self::HAS_PERMISSION
        ];
    }
}
