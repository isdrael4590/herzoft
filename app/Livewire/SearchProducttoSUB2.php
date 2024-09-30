<?php

namespace App\Livewire;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Request;

use Livewire\Component;

class SearchProducttoSUB extends Component
{

    public $description_input;
    public $results_input;
    public $how_many;
    private $subproduct;


    public function mount()
    {
        $this->description_input = '';
        $this->how_many = 10;
        $this->results_input = Collection::empty();
    }

    public function render()
    {
        return view('livewire.search-producttoSUB');
    }
  
    public function updatedQuery()
    {
       $this->results_input= ($this->description_input)->getData();
     
    }

    public function loadMore() {
        $this->how_many += 10;
        $this->updatedQuery();
      
    }
    public function resetInput()
    {
        $this->description_input = '';
        $this->how_many = 10;
        $this->results_input = Collection::empty();
    }


    public function selectSubProduct($subproduct) {
        dd('prueba produ',$subproduct);
        $this->dispatch('selectSubProduct', $subproduct);
    }
}
;