<?php

namespace App\Livewire\Search;

use App\Models\Product;
use Livewire\Component;

class SearchFormComponent extends Component
{
    public string $term = '';

    public function search()
    {
        if ($this->term) {
            $this->redirectRoute('search', ['query' => $this->term], navigate: true);
        }
    }

    public function render()
    {
        $searchResults = [];

        if (mb_strlen($this->term, 'UTF-8') > 1) {
            $searchResults = Product::query()
                ->whereLike('title', '%' . $this->term . '%')
                ->limit(10)
                ->get();
        }

        return view('livewire.search.search-form-component', [
            'search_results' => $searchResults,
        ]);
    }
}
