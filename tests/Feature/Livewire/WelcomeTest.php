<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WelcomeTest extends TestCase
{
    use RefreshDatabase;

    public function test_shows_landing_page_info(): void
    {
        $response = $this->get('/');

        $response->assertSee('@source');
        $response->assertSee('Interview Test');
        $response->assertSee('This is a live preview . As part of the FullStack Developer position interview process at Bored Panda.');
    }
}
