<?php

namespace Tests\Feature;

use Tests\TestCase;

class EnvironmentTest extends TestCase
{
    public function test_app_environment_is_testing()
    {
        $this->assertEquals('testing', config('app.env'));
    }
}
