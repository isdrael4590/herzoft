<?php

namespace App\Livewire\Reports;

use Livewire\Component;
use Carbon\Carbon;
use Livewire\WithPagination;
use Modules\Expedition\Entities\Expedition;

class ExpeditionReport extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $area_expedition;
    public $startDate;
    public $endDate;
    public $status_expedition;
    public $data = [];
    public $selectedItems = [];
    public $selectAll = false;

    public function mount()
    {
        $this->area_expedition = '';
        $this->startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->endDate = Carbon::now()->format('Y-m-d');
        $this->status_expedition = '';
        $this->loadData();
    }

    public function loadData()
    {
        $this->data= Expedition::whereBetween('updated_at', [
            $this->startDate . ' 00:00:00',
            $this->endDate . ' 23:59:59',
        ])
        ->when($this->status_expedition, function ($query) {
            return $query->where('status_expedition', $this->status_expedition);
        })
        ->when($this->area_expedition, function ($query) {
            return $query->where('area_expedition', $this->area_expedition);
        })
        ->orderBy('updated_at', 'desc')->get()->toArray();

        // Reset selections when data changes
        $this->selectedItems = collect($this->data)->pluck('id')->map(fn($id) => (string) $id)->toArray();;
        $this->selectAll = true;
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedItems = collect($this->data)->pluck('id')->map(fn($id) => (string) $id)->toArray();
        } else {
            $this->selectedItems = [];
        }
    }


    public function print()
    {
        if (empty($this->selectedItems)) {
            session()->flash('message', 'Please select at least one item to print.');
            return;
        }

        return redirect()->route('printexp.data', [
            'items' => implode(',', $this->selectedItems),
        ]);
    }

    public function render()
    {


        return view('livewire.reports.expeditions-report', [
            'data' => $this->data,
            'selectedItems' => $this->selectedItems,
            'selectAll' => $this->selectAll,
        ]);
    }

  
}
