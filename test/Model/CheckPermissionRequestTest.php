<?php

namespace Chiphpotle\Rest\Test\Model;

use Chiphpotle\Rest\Model\CheckPermissionRequest;
use Chiphpotle\Rest\Model\ObjectReference;
use Chiphpotle\Rest\Model\SubjectReference;
use PHPUnit\Framework\TestCase;

final class CheckPermissionRequestTest extends TestCase
{
    public function test_to_string_method()
    {
        $request = new CheckPermissionRequest(
            ObjectReference::create(
                'document',
                'mydoc'
            ),
            'read',
            SubjectReference::create(
                'user',
                'alice'
            )
        );
        $this->assertEquals('document:mydoc#read@user:alice', (string)$request);
    }

    public function test_to_string_method_with_optional_relationship()
    {
        $request = new CheckPermissionRequest(
            ObjectReference::create(
                'document',
                'mydoc'
            ),
            'read',
            SubjectReference::create(
                'user',
                'alice',
                'mygroup'
            )
        );
        $this->assertEquals('document:mydoc#read@user:alice#mygroup', (string)$request);
    }
}
