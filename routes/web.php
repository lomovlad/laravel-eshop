<?php

use App\Livewire\Admin\Category\CategoryCreateComponent;
use App\Livewire\Admin\Category\CategoryEditComponent;
use App\Livewire\Admin\Category\CategoryIndexComponent;
use App\Livewire\Admin\Filter\FilterCreateComponent;
use App\Livewire\Admin\Filter\FilterEditComponent;
use App\Livewire\Admin\Filter\FilterGroupCreateComponent;
use App\Livewire\Admin\Filter\FilterGroupEditComponent;
use App\Livewire\Admin\Filter\FilterGroupIndexComponent;
use App\Livewire\Admin\Filter\FilterIndexComponent;
use App\Livewire\Admin\Product\ProductCreateComponent;
use App\Livewire\Admin\Product\ProductEditComponent;
use App\Livewire\Admin\Product\ProductIndexComponent;
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

    Route::get('/categories', CategoryIndexComponent::class)->name('admin.categories.index');
    Route::get('/categories/create', CategoryCreateComponent::class)->name('admin.categories.create');
    Route::get('/categories/{category}/edit', CategoryEditComponent::class)->name('admin.categories.edit');

    Route::get('/products', ProductIndexComponent::class)->name('admin.products.index');
    Route::get('/products/create', ProductCreateComponent::class)->name('admin.products.create');
    Route::get('/products/{product}/edit', ProductEditComponent::class)->name('admin.products.edit');

    Route::get('/filter-groups', FilterGroupIndexComponent::class)->name('admin.filter-groups.index');
    Route::get('/filter-groups/create', FilterGroupCreateComponent::class)->name('admin.filter-groups.create');
    Route::get('/filter-groups/{filter_group}/edit', FilterGroupEditComponent::class)->name('admin.filter-groups.edit');

    Route::get('/filters', FilterIndexComponent::class)->name('admin.filters.index');
    Route::get('/filters/create', FilterCreateComponent::class)->name('admin.filters.create');
    Route::get('/filters/{filter}/edit', FilterEditComponent::class)->name('admin.filters.edit');
});
