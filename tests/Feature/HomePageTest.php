<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Проверяет доступность главной страницы
     *
     * @return void
     */
    public function test_home_page_is_available(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
