<?php

namespace App\Livewire;

use Illuminate\Support\Collection;
use Livewire\Component;
use Modules\Preparation\Entities\PreparationDetails;
use Modules\Product\Entities\Product;

class SearchProduct extends Component
{

    public $query;
    public $search_results;
    public $how_many;

    public function mount()
    {
        $this->query = '';
        $this->how_many = 10;
        $this->search_results = Collection::empty();
    }
    public $selectedIndex = 0;

    public function moveUp()
    {
        if ($this->selectedIndex > 0) {
            $this->selectedIndex--;
        }
    }

    public function moveDown()
    {
        if ($this->selectedIndex < count($this->search_results) - 1) {
            $this->selectedIndex++;
        }
    }

    public function selectRow()
    {
        $selectedRow = $this->search_results[$this->selectedIndex];
        // Perform the desired action with the selected row.
        session()->flash('message', "Selected: $selectedRow");
    }


    public $barcode = '';




    public function render()
    {
        return view('livewire.search-product');
    }

    public function updatedQuery()
    {
        $this->search_results = Product::where('area', 'like', '%' . $this->query . '%')
            ->orWhere('product_code',  'like', '%' . $this->query . '%')
            ->orWhere('product_name', 'like', '%' . $this->query . '%')
            ->take($this->how_many)->get();
    }

    public function loadMore()
    {
        $this->updatedBarcode();

        $this->how_many += 10;
        $this->updatedQuery();
    }

    public function resetQuery()
    {
        $this->query = '';
        $this->how_many = 10;
        $this->search_results = Collection::empty();
    }

    public function selectProduct($product)
    {

        $this->dispatch('productSelected', $product);
    }
}
