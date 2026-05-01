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
    public $barcode = '';

    public function mount()
    {
        $this->query = '';
        $this->how_many = 10;
        $this->search_results = Collection::empty();
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

        $this->dispatch('searchUpdated');
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
