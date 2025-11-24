<?php

namespace App\Livewire\Product;

use App\Helpers\Traits\CartTrait;
use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;


class CategoryComponent extends Component
{
    use WithPagination, CartTrait;

    public string $slug = '';

    #[Url]
    public string $sort = 'default';
    public array $sortList = [
        'default' => [
            'title' => 'Default',
            'orderField' => 'id',
            'orderDirection' => 'desc',
        ],
        'name-asc' => [
            'title' => 'Name (a-z)',
            'orderField' => 'title',
            'orderDirection' => 'asc',
        ],
        'name-desc' => [
            'title' => 'Name (z-a)',
            'orderField' => 'title',
            'orderDirection' => 'desc',
        ],
        'price-asc' => [
            'title' => 'Price (low > high)',
            'orderField' => 'price',
            'orderDirection' => 'asc',
        ],
        'price-desc' => [
            'title' => 'Price (low < high)',
            'orderField' => 'price',
            'orderDirection' => 'desc',
        ],
    ];

    #[Url]
    public int $limit = 3;
    public array $limitList = [3, 6, 9, 12];
    public function mount($slug)
    {
        $this->slug = $slug;
    }
    public function changeSort(): void
    {
        $this->sort = isset($this->sortList[$this->sort]) ? $this->sort : 'default';
    }
    public function changeLimit(): void
    {
        $this->limit = in_array($this->limit, $this->limitList) ? $this->limit : $this->limitList[0];
        $this->resetPage();
    }

    public function render()
    {
        $category = Category::query()->where('slug', '=', $this->slug)->firstOrFail();
        $ids = \App\Helpers\Category\Category::getIds($category->id) . $category->id;
        $products = Product::query()
            ->whereIn('category_id', explode(',', $ids))
            ->orderBy($this->sortList[$this->sort]['orderField'], $this->sortList[$this->sort]['orderDirection'])
            ->paginate($this->limit);

        return view('livewire.product.category-component', [
            'products' => $products,
            'category' => $category,
        ]);
    }
}
