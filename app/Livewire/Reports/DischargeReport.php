<?php

namespace App\Livewire\Reports;

use Livewire\Component;
use Carbon\Carbon;
use Livewire\WithPagination;
use Modules\Discharge\Entities\Discharge;
use Modules\Discharge\Entities\DischargeDetails;

class DischargeReport extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $machines;
    public $startDate;
    public $endDate;
    public $machine_name;
    public $validation_biologic;
    public $status_cycle;

    public $data = [];
    public $selectedItems = [];
    public $selectAll = false;



    public function mount()
    {
        $this->machines = '';
        $this->startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->endDate = Carbon::now()->format('Y-m-d');
        $this->machine_name = '';
        $this->status_cycle = '';
        $this->validation_biologic = '';
        $this->loadData();
    }

    public function loadData()
    {
        $data = Discharge::with('dischargeDetails')
            ->whereBetween('updated_at', [
                $this->startDate . ' 00:00:00',
                $this->endDate . ' 23:59:59',
            ])
            ->when($this->machine_name, function ($query) {
                return $query->where('machine_name', $this->machine_name);
            })
            ->when($this->status_cycle, function ($query) {
                return $query->where('status_cycle', $this->status_cycle);
            })
            ->when($this->validation_biologic, function ($query) {
                return $query->where('validation_biologic', $this->validation_biologic);
            })
            ->orderBy('updated_at', 'desc')->get();
            $this->data = $data->map(function ($discharge) {
                $dischargeArray = $discharge->toArray();
                $dischargeArray['details_count'] = $discharge->dischargeDetails->count();
                return $dischargeArray;
            })        
            ->toArray();

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

        return redirect()->route('printdisch.data', [
            'items' => implode(',', $this->selectedItems),
        ]);
    }

    public function render()
    {


        return view('livewire.reports.discharges-report', [
            'data' => $this->data,
            'selectedItems' => $this->selectedItems,
            'selectAll' => $this->selectAll,
        ]);
    }
}
