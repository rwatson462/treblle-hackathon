<?php

namespace Tests\Feature;

use Tests\TestCase;

class RouteTest extends TestCase
{
    public function test_requestToIndexReturnsNotFound(): void
    {
        $response = $this->get('/')
            ->assertStatus(404);

        $this->assertHeaders($response);

        $response = $this->post('/')
            ->assertStatus(404);

        $this->assertHeaders($response);
    }
}
