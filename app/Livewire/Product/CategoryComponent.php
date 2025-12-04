<?php

namespace App\Livewire\Product;

use App\Helpers\Traits\CartTrait;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
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

    #[Url]
    public array $selected_filters = [];

    #[Url]
    public $min_price;

    #[Url]
    public $max_price;

    public function mount($slug)
    {
        $this->slug = $slug;

        if (!isset($this->sortList[$this->sort]) || !in_array($this->limit, $this->limitList)) {
            $this->redirectRoute('category', ['slug' => $slug], navigate: true);
        }
    }

    public function updated($property): void
    {
        $property = explode('.', $property);

        if (in_array($property[0], ['selected_filters', 'min_price', 'max_price'])) {
            $this->resetPage();
        }
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

    public function removeFilter($filter_id): void
    {
        if (false !== ($key = array_search($filter_id, $this->selected_filters))) {
            unset($this->selected_filters[$key]);
            $this->selected_filters = array_values($this->selected_filters);
            $this->resetPage();
        }
    }

    public function clearFilters(): void
    {
        $this->selected_filters = [];
        $this->resetPage();
    }

    public function render()
    {
        $category = Category::query()->where('slug', '=', $this->slug)->firstOrFail();
        $ids = \App\Helpers\Category\Category::getIds($category->id) . $category->id;

        if (is_null($this->min_price) || is_null($this->max_price)) {
            $min_max_price = DB::table('products')
                ->select(DB::raw('min(price) as min_price, max(price) as max_price'))
                ->whereIn('category_id', explode(',', $ids))
                ->get();
            $this->min_price = $this->min_price ?? $min_max_price[0]->min_price;
            $this->max_price = $this->max_price ?? $min_max_price[0]->max_price;
        }

        $category_filters = DB::table('category_filters')
            ->select('category_filters.filter_group_id', 'filter_groups.title', 'filters.id as filter_id', 'filters.title as filter_title')
            ->join('filter_groups', 'category_filters.filter_group_id', '=', 'filter_groups.id')
            ->join('filters', 'filters.filter_group_id', '=', 'filter_groups.id')
            ->whereIn('category_filters.category_id', explode(',', $ids))
            ->get();
        $filter_groups = [];

        foreach ($category_filters as $filter) {
            $filter_groups[$filter->filter_group_id][] = $filter;
        }

        if ($this->selected_filters) {
            $cntFilterGroups = DB::table('filters')
                ->select(DB::raw('count(distinct filter_group_id) as cnt'))
                ->whereIn('id', $this->selected_filters)
                ->value('cnt');
        } else {
            $cntFilterGroups = 1;
        };

        $products = Product::query()
            ->whereIn('category_id', explode(',', $ids))
            ->when($this->selected_filters, function (Builder $query) use ($cntFilterGroups) {
                $query
                    ->select('products.*')
                    ->leftJoin(DB::raw('filter_products FORCE INDEX FOR JOIN (filter_id)'), 'filter_products.product_id', '=', 'products.id')
                    ->whereIn('filter_products.filter_id', $this->selected_filters)
                    ->groupBy('products.id')
                    ->havingRaw("count(distinct filter_products.filter_group_id) >= ?", [$cntFilterGroups]);
            })
            ->whereBetween('price', [$this->min_price, $this->max_price])
            ->orderBy($this->sortList[$this->sort]['orderField'], $this->sortList[$this->sort]['orderDirection'])
            ->paginate($this->limit);
        $breadcrumbs = \App\Helpers\Category\Category::getBreadcrumbs($category->id);

        return view('livewire.product.category-component', [
            'products' => $products,
            'category' => $category,
            'breadcrumbs' => $breadcrumbs,
            'filter_groups' => $filter_groups,
        ]);
    }
}
