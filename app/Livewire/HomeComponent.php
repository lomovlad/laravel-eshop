<?php

namespace App\Livewire;

use App\Helpers\Traits\CartTrait;
use App\Models\Product;
use Livewire\Component;

class HomeComponent extends Component
{
    use CartTrait;
    public function render()
    {
        $hitsProducts = Product::query()
            ->orderBy('id', 'desc')
            ->where('is_hit', '=', 1)
            ->limit(4)
            ->get();
        $newProducts = Product::query()
            ->orderBy('id', 'desc')
            ->where('is_new', '=', 1)
            ->limit(8)
            ->get();

        return view('livewire.home-component', [
            'hitsProducts' => $hitsProducts,
            'newProducts' => $newProducts,
            'title' => 'Home page',
            'desc' => 'Description of home page',
        ]);
    }


}
