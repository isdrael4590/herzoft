<?php

namespace App\Livewire;

use Illuminate\Support\Collection;
use Livewire\Component;
use Modules\Stock\Entities\StockDetails;

class SearchProducttoEXP extends Component
{

    public $query;
    public $search_results;
    public $how_many;

    public function mount() {
        $this->query = '';
        $this->how_many = 10;
        $this->search_results = Collection::empty();
    }

    public function render() {
        return view('livewire.search-producttoEXP');
    }

    public function updatedQuery() {
        $this->search_results = StockDetails::where('product_area', 'like', '%' . $this->query . '%')
            ->where('product_quantity','>=',1)
            ->orWhere('product_code', 'like', '%' . $this->query . '%')
            ->where('product_quantity','>=',1)
            ->take($this->how_many)->get();
    }

    public function loadMore() {
        $this->how_many += 10;
        $this->updatedQuery();
    }

    public function resetQuery() {
        $this->query = '';
        $this->how_many = 10;
        $this->search_results = Collection::empty();
    }

    public function selectProduct($product) {
        $this->dispatch('productSelected', $product);
    }
}
