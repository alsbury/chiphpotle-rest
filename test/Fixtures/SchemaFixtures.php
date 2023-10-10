<?php

namespace Chiphpotle\Rest\Test\Fixtures;

final class SchemaFixtures
{
    public const SAMPLE_SCHEMA = <<<SCHEMA
definition user {}

caveat published(status string) {
	status == 'published'
}

definition document {
	relation writer: user
	relation viewer: user | user with published
	permission write = writer
	permission view = viewer + writer
}
SCHEMA;

}
