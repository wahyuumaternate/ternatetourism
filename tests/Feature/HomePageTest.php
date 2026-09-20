<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomePageTest extends TestCase
{
    public function test_home_page_renders_the_redesigned_layout(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('Discover', false);
        $response->assertSee('id="main"', false);
        $response->assertSee('lang="id"', false);
    }

    public function test_language_can_be_switched_to_english(): void
    {
        $this->get(route('lang.switch', 'en'))->assertRedirect();

        $this->get('/')->assertOk()->assertSee('lang="en"', false)->assertSee('View Destinations');
    }
}
