<?php

namespace App\Livewire\Reports;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Testbd\Entities\Testbd;

class TestbdReport extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $startDate;
    public $endDate;
    public $machine_name;
    public $testbd_validation;

    
    public $data = [];
    public $selectedItems = [];
    public $selectAll = false;

    public function mount() {

        $this->startDate = today()->startOfMonth()->format('Y-m-d');
        $this->endDate = today()->format('Y-m-d');
        $this->machine_name = '';
        $this->testbd_validation = '';
        $this->loadData();

    }



    public function loadData()
    {
        $this->data = Testbd::whereBetween('updated_at', [
            $this->startDate . ' 00:00:00',
            $this->endDate . ' 23:59:59',
        ])
        ->when($this->machine_name, function ($query) {
            return $query->where('machine_name', $this->machine_name);
        })
        ->when($this->testbd_validation, function ($query) {
            return $query->where('validation_bd', $this->testbd_validation);
        })
        ->orderBy('updated_at', 'desc')->get()->toArray();
        $this->selectedItems = collect($this->data)->pluck('id')->map(fn($id) => (string) $id)->toArray();
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
    public function printtbd()
    {
        if (empty($this->selectedItems)) {
            session()->flash('message', 'Please select at least one item to print.');
            return;
        }

        return redirect()->route('printtbd.data', [
            'items' => implode(',', $this->selectedItems),
        ]);
    }

    public function render()
    {
      

        return view('livewire.reports.testbds-report', [
            'data' => $this->data,
            'selectedItems' => $this->selectedItems,
            'selectAll' => $this->selectAll,
        ]);
    }


}
