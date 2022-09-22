<?php

namespace Chiphpotle\Rest\Enum;

class RelationshipUpdateOperation
{
    public const UNSPECIFIED = 'OPERATION_UNSPECIFIED';

    public const CREATE = 'OPERATION_CREATE';

    public const TOUCH = 'OPERATION_TOUCH';

    public const DELETE = 'OPERATION_DELETE';

    /**
     * @return string[]
     */
    public static function getAllowableEnumValues(): array
    {
        return [
            self::UNSPECIFIED,
            self::CREATE,
            self::TOUCH,
            self::DELETE
        ];
    }

}