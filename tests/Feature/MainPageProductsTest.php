<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MainPageProductsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Проверяет, что главная страница выводит продукты.
     *
     * @return void
     */
    public function test_main_page_displays_products(): void
    {
        $category = Category::factory()->create([
            'parent_id' => 0,
        ]);
        $product = Product::factory()->create([
            'title' => 'Test product',
            'category_id' => $category->id,
        ]);
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Test product');
    }
}
