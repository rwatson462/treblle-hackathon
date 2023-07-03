<?php

namespace Tests\Feature;

use Tests\TestCase;

class RouteTest extends TestCase
{
    public function test_requestToIndexReturnsNotFound(): void
    {
        $this->get('/')
            ->assertStatus(404);

        $this->post('/')
            ->assertStatus(404);
    }
}
