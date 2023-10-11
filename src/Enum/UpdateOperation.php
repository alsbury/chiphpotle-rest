<?php

namespace Chiphpotle\Rest\Enum;

final class UpdateOperation extends BaseEnum
{
    public const UNSPECIFIED = 'OPERATION_UNSPECIFIED';

    public const CREATE = 'OPERATION_CREATE';

    public const TOUCH = 'OPERATION_TOUCH';

    public const DELETE = 'OPERATION_DELETE';

    public static function allowableValues(): array
    {
        return [
            self::CREATE,
            self::TOUCH,
            self::DELETE
        ];
    }
}
