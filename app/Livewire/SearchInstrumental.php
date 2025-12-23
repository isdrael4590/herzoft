<?php

namespace App\Livewire;

use Illuminate\Support\Collection;
use Livewire\Component;
use Modules\Product\Entities\Instrumental;

class SearchInstrumental extends Component
{
    public $query;
    public $search_results;
    public $how_many;
    public $selectedIndex = 0;
    public $barcode = '';

    public function mount()
    {
        $this->query = '';
        $this->how_many = 10;
        $this->search_results = Collection::empty();
    }

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
        session()->flash('message', "Selected: $selectedRow");
    }

    public function render()
    {
        return view('livewire.search-instrumental');
    }

    public function updatedQuery()
    {
        if (empty($this->query)) {
            $this->search_results = Collection::empty();
            return;
        }

        $this->search_results = Instrumental::query()
            // 1. Condición OBLIGATORIA (El filtro estricto)
            ->where('estado_actual', 'DISPONIBLE')

            // 2. Agrupamiento de la búsqueda (Equivalente a paréntesis en SQL)
            ->where(function ($q) {
                $q->where('codigo_unico_ud', 'like', '%' . $this->query . '%')
                    ->orWhere('nombre_generico', 'like', '%' . $this->query . '%')
                    ->orWhere('tipo_familia', 'like', '%' . $this->query . '%')
                    ->orWhere('marca_fabricante', 'like', '%' . $this->query . '%');
            })
            ->take($this->how_many)
            ->get();
    }

    public function loadMore()
    {
        $this->how_many += 10;
        $this->updatedQuery();
    }

    public function resetQuery()
    {
        $this->query = '';
        $this->how_many = 10;
        $this->search_results = Collection::empty();
    }

    public function selectInstrumental($instrumental)
    {

        // Enviar como array
        $this->dispatch('instrumentalSelected', $instrumental);
    }
}
