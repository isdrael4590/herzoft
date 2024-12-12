<?php

namespace App\Livewire;

use Illuminate\Support\Collection;
use Livewire\Component;
use Modules\Preparation\Entities\PreparationDetails;
class SearchProducttoQR extends Component
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
        return view('livewire.search-producttoQR');
    }

    public function updatedQuery() {
        $this->search_results = PreparationDetails::where('product_area', 'like', '%' . $this->query . '%')
            ->where('product_quantity','>=',1)
            ->orWhere('product_code', 'like', '%' . $this->query . '%')
            ->where('product_quantity','>=',1)
            ->orWhere('product_name', 'like', '%' . $this->query . '%')
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
