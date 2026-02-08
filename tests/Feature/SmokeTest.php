<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SmokeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function simple_assertion()
    {
        $this->assertTrue(true);
    }
}
