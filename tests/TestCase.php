<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Testing\TestResponse;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;

    protected function assertHeaders(TestResponse $response): void
    {
        $response->assertHeader('content-type', 'application/json');
        $response->assertHeader('content-security-policy');
        // todo add the other headers here
    }
}
