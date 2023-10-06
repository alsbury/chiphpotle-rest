<?php

namespace Chiphpotle\Rest\Test\Model;

use Chiphpotle\Rest\Model\CheckPermissionRequest;
use Chiphpotle\Rest\Model\ObjectReference;
use Chiphpotle\Rest\Model\SubjectReference;

class CheckPermissionRequestTest extends \PHPUnit\Framework\TestCase
{
    public function test_to_string_method()
    {
        $request = new CheckPermissionRequest(
            SubjectReference::create(
                'user',
                'alice'
            ),
            'read',
            ObjectReference::create(
                'document',
                'mydoc'
            )
        );
        $this->assertEquals('document:mydoc#read@user:alice', (string)$request);
    }

    public function test_to_string_method_with_optional_relationship()
    {
        $request = new CheckPermissionRequest(
            SubjectReference::create(
                'user',
                'alice',
                'mygroup'
            ),
            'read',
            ObjectReference::create(
                'document',
                'mydoc'
            )
        );
        $this->assertEquals('document:mydoc#read@user:alice#mygroup', (string)$request);
    }
}
