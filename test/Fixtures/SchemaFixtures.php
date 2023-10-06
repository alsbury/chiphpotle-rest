<?php

namespace Chiphpotle\Rest\Test\Fixtures;

class SchemaFixtures
{
    public const SAMPLE_SCHEMA = <<<SCHEMA
definition user {}

definition document {
	relation writer: user
	relation viewer: user
	permission write = writer
	permission view = viewer + writer
}
SCHEMA;

}
