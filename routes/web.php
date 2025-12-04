<?php

use App\Livewire\HomeComponent;
use App\Livewire\Product\CategoryComponent;
use App\Livewire\Product\ProductComponent;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeComponent::class)->name('home');
Route::get('/product/{slug}', ProductComponent::class)->name('product');
Route::get('/category/{slug}', CategoryComponent::class)->name('category');
