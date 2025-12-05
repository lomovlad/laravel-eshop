<?php

use App\Livewire\HomeComponent;
use App\Livewire\Product\CategoryComponent;
use App\Livewire\Product\ProductComponent;
use App\Livewire\User\LoginComponent;
use App\Livewire\User\RegisterComponent;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeComponent::class)->name('home');
Route::get('/product/{slug}', ProductComponent::class)->name('product');
Route::get('/category/{slug}', CategoryComponent::class)->name('category');

Route::middleware('guest')->group(function () {
    Route::get('/register', RegisterComponent::class)->name('register');
    Route::get('/login', LoginComponent::class)->name('login');

});
