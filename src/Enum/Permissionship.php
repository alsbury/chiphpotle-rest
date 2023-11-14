<?php

namespace Chiphpotle\Rest\Enum;

/**
 * Permissionship communicates whether the subject has the requested permission or has a relationship with the
 * given resource, over the given relation.
 */
enum Permissionship: string
{
    case UNSPECIFIED = 'PERMISSIONSHIP_UNSPECIFIED';
    case NO_PERMISSION = 'PERMISSIONSHIP_NO_PERMISSION';
    case HAS_PERMISSION = 'PERMISSIONSHIP_HAS_PERMISSION';
    case CONDITIONAL_PERMISSION = 'PERMISSIONSHIP_CONDITIONAL_PERMISSION';
}
