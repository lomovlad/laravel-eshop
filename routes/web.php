<?php

use App\Livewire\Cart\Cart;
use App\Livewire\Cart\CheckoutComponent;
use App\Livewire\Product\CategoryComponent;
use App\Livewire\Product\ProductComponent;
use App\Livewire\Search\SearchComponent;
use App\Livewire\User\AccountComponent;
use App\Livewire\User\ChangeAccountComponent;
use App\Livewire\User\LoginComponent;
use App\Livewire\User\OrdersComponent;
use App\Livewire\User\OrderShowComponent;
use App\Livewire\User\RegisterComponent;
use Illuminate\Support\Facades\Route;

Route::get('/', \App\Livewire\HomeComponent::class)->name('home');
Route::get('/product/{slug}', ProductComponent::class)->name('product');
Route::get('/category/{slug}', CategoryComponent::class)->name('category');
Route::get('/cart', Cart::class)->name('cart');
Route::get('/checkout', CheckoutComponent::class)->name('checkout');
Route::get('/search', SearchComponent::class)->name('search');

Route::middleware('guest')->group(function () {
    Route::get('/register', RegisterComponent::class)->name('register');
    Route::get('/login', LoginComponent::class)->name('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', function () {
        auth()->logout();
        return redirect()->route('login');
    })->name('logout');
    Route::get('/account', AccountComponent::class)->name('account');
    Route::get('/change-account', ChangeAccountComponent::class)->name('change-account');
    Route::get('/orders', OrdersComponent::class)->name('orders');
    Route::get('/order-show/{id}', OrderShowComponent::class)->name('order-show');
});

Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/', \App\Livewire\Admin\HomeComponent::class)->name('admin');
});
