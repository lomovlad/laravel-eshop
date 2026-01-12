<?php

namespace App\Livewire\Admin\Filter;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Create Filter Group')]
class FilterCreateComponent extends Component
{
    public function render()
    {
        return view('livewire.admin.filter.filter-create-component');
    }
}
