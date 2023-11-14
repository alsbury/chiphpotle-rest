<?php

namespace Chiphpotle\Rest\Enum;

enum UpdateOperation: string
{
    case UNSPECIFIED = 'OPERATION_UNSPECIFIED';
    case CREATE = 'OPERATION_CREATE';
    case TOUCH = 'OPERATION_TOUCH';
    case DELETE = 'OPERATION_DELETE';
}
