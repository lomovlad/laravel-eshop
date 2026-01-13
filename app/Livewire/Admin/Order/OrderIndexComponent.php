<?php

namespace App\Livewire\Admin\Order;

use App\Models\Order;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
#[Title('Orders List')]
class OrderIndexComponent extends Component
{
    use WithPagination;

    public function render()
    {
        $orders = Order::query()->orderBy('id', 'desc')->paginate(15);

        return view('livewire.admin.order.order-index-component', compact('orders'));
    }
}
