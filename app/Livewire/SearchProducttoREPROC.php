<?php

namespace App\Livewire;

use Illuminate\Support\Collection;
use Livewire\Component;
use Modules\Discharge\Entities\DischargeDetails;

class SearchProducttoREPROC extends Component
{

    public $query;
    public $search_resultREPROCs;
    public $how_many;

    public function mount() {
        $this->query = '';
        $this->how_many = 10;
        $this->search_resultREPROCs = Collection::empty();
    }

    public function render() {
        return view('livewire.search-producttoREPROC');
    }

    public function updatedQuery() {
        $this->search_resultREPROCs = DischargeDetails::where('product_name', 'like', '%' . $this->query . '%')
            ->where('product_ref_qr','=','Reprocesar')
            ->orWhere('product_code', 'like', '%' . $this->query . '%')
            ->where('product_ref_qr','=','Reprocesar')
            ->take($this->how_many)->get();
    }

    public function loadMore() {
        $this->how_many += 10;
        $this->updatedQuery();
    }

    public function resetQuery() {
        $this->query = '';
        $this->how_many = 10;
        $this->search_resultREPROCs = Collection::empty();
    }

    public function selectProduct($product) {
        $this->dispatch('productSelected', $product);
    }
}
