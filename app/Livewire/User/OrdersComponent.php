<?php

namespace App\Livewire\User;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class OrdersComponent extends Component
{
    use WithPagination;

    public function render()
    {
        $orders = Order::query()
            ->where('user_id', '=', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('livewire.user.orders-component', [
            'orders' => $orders,
            'title' => "Orders",
        ]);
    }
}
