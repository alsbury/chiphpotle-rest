<?php

namespace Chiphpotle\Rest\Enum;

enum PreconditionOperation: string
{
    case UNSPECIFIED = 'OPERATION_UNSPECIFIED';
    case MUST_MATCH = 'OPERATION_MUST_MATCH';
    case MUST_NOT_MATCH = 'OPERATION_MUST_NOT_MATCH';
}
