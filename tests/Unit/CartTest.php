<?php

namespace Tests\Unit;

use App\Helpers\Cart\Cart;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;


class CartTest extends TestCase
{
    /**
     * Сброс сессии после каждого теста
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        Session::flush();
    }

    /**
     * Проверка на добавления товара в корзину
     *
     * @return void
     */
    public function test_it_can_add_product_to_cart(): void
    {
        $productId = 1;
        $productData = [
            'title' => 'Test Product',
            'slug' => 'test-product',
            'price' => 100,
            'quantity' => 2,
            'image' => 'no-image.png'
        ];
        Session::put("cart.$productId", $productData);

        $this->assertTrue(Cart::hasProductInCart($productId));
        $this->assertEquals(1, Cart::getCartQuantityItems());
        $this->assertEquals(2, Cart::getCartQuantityTotal());
        $this->assertEquals(200, Cart::getCartTotalSum());
    }

    /**
     * Провверка на изменение количества товара, если он уже в корзине
     *
     * @return void
     */
    public function test_it_can_update_product_quantity(): void
    {
        $productId = 1;
        $productData = [
            'title' => 'Test Product',
            'slug' => 'test-product',
            'price' => 100,
            'quantity' => 1,
            'image' => 'no-image.png'
        ];
        Session::put("cart.$productId", $productData);
        $result = Cart::updateItemQuantity($productId, 5);

        $this->assertTrue($result);
        $this->assertEquals(5, Cart::getCartQuantityTotal());
        $this->assertEquals(500, Cart::getCartTotalSum());
    }

    /**
     * Проверка пустоты корзины после удаления товара
     *
     * @return void
     */
    public function test_it_can_remove_product_from_cart(): void
    {
        $productId = 1;
        $productData = [
            'title' => 'Test Product',
            'slug' => 'test-product',
            'price' => 100,
            'quantity' => 2,
            'image' => 'no-image.png'
        ];
        Session::put("cart.$productId", $productData);
        $result = Cart::removeProductFromCart($productId);

        $this->assertTrue($result);
        $this->assertFalse(Cart::hasProductInCart($productId));
        $this->assertEquals(0, Cart::getCartQuantityItems());
    }
}
