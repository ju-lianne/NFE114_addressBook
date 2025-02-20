<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;
    public function testDashboardAccessible()
    {
        $response = $this->get('/dashboard');

        $response->assertStatus(200);
    }
}
