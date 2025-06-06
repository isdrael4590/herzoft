<?php

namespace App\Livewire;

use Illuminate\Support\Collection;
use Livewire\Component;
use Modules\Preparation\Entities\PreparationDetails;
class SearchProducttoQRHPO extends Component
{

    public $query;
    public $search_results;
    public $how_many;
        public $allowed_product_types = ['Baja Temperatura']; // Tipos permitidos

    public function mount() {
        $this->query = '';
        $this->how_many = 10;
        $this->search_results = Collection::empty();
    }

    public function render() {
        return view('livewire.search-producttoQRHPO');
    }

    public function updatedQuery() {
     $this->search_results = PreparationDetails::where(function($query) {
                $query->where('product_area', 'like', '%' . $this->query . '%')
                      ->orWhere('product_code', 'like', '%' . $this->query . '%')
                      ->orWhere('product_name', 'like', '%' . $this->query . '%');
            })
            ->where('product_quantity', '>=', 1)
            ->where('product_type_process', $this->allowed_product_types) // Filtrar por product_type
            ->take($this->how_many)
            ->get();
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
