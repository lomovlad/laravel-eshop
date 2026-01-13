<?php

namespace App\Livewire\Admin\Filter;

use App\Models\Filter;
use App\Models\FilterGroup;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Filter Groups')]
class FilterGroupIndexComponent extends Component
{
    public function deleteFilterGroup(FilterGroup $filter_group)
    {
        try {
            DB::beginTransaction();
            DB::table('filter_products')
                ->where('filter_group_id', '=', $filter_group->id)
                ->delete();
            Filter::query()
                ->where('filter_group_id', '=', $filter_group->id)
                ->delete();
            DB::table('category_filters')
                ->where('filter_group_id', '=', $filter_group->id)
                ->delete();
            $filter_group->delete();
            DB::commit();
            $this->js("toastr.success('Filter group removed')");
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            $this->js("toastr.error('Error deleting filter group')");
        }
    }

    public function render()
    {
        $filter_groups = FilterGroup::all();

        return view('livewire.admin.filter.filter-group-index-component', compact('filter_groups'));
    }
}
