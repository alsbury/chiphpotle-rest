<?php

namespace Chiphpotle\Rest\Enum;


enum AlgebraicOperation: string
{
    case UNSPECIFIED = 'OPERATION_UNSPECIFIED';
    case UNION = 'OPERATION_UNION';
    case INTERSECTION = 'OPERATION_INTERSECTION';
    case EXCLUSION = 'OPERATION_EXCLUSION';
}
