<?php

namespace App\Livewire\Admin\Filter;

use App\Models\FilterGroup;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Filter Groups')]
class FilterGroupIndexComponent extends Component
{
    public function render()
    {
        $filter_groups = FilterGroup::all();

        return view('livewire.admin.filter.filter-group-index-component', compact('filter_groups'));
    }
}
