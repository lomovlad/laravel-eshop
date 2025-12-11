<?php

namespace App\Livewire\Admin\Category;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Categories')]
class CategoryIndexComponent extends Component
{
    public function render()
    {
        return view('livewire.admin.category.category-index-component');
    }
}
