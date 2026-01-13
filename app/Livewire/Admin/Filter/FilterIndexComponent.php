<?php

namespace App\Livewire\Admin\Filter;

use App\Models\Filter;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
#[Title('Filter List')]
class FilterIndexComponent extends Component
{
    use WithPagination;

    public function render()
    {
        $filters = Filter::query()->with('group')->paginate();

        return view('livewire.admin.filter.filter-index-component', compact('filters'));
    }
}
