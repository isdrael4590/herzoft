<?php
namespace App\Livewire\Reports;

use Livewire\Component;
use Carbon\Carbon;
use Livewire\WithPagination;
use Modules\Reception\Entities\Reception;

class ReceptionReport extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';
    
    public $startDate;
    public $endDate;
    public $area;
    public $status;
    public $data = [];
    public $selectedItems = [];
    public $selectAll = false;

    public function mount()
    {
        $this->startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->endDate = Carbon::now()->format('Y-m-d');
        $this->area = '';
        $this->status = '';
        $this->loadData();
    }

    public function loadData()
    {
        // Cargar datos con la relación de detalles y contar los detalles
        $receptions = Reception::with('receptionDetails') // Asumiendo que tienes la relación definida
            ->whereBetween('updated_at', [
                $this->startDate . ' 00:00:00',
                $this->endDate . ' 23:59:59',
            ])
            ->when($this->area, function ($query) {
                return $query->where('area', $this->area);
            })
            ->when($this->status, function ($query) {
                return $query->where('status', $this->status);
            })
            ->orderBy('updated_at', 'desc')
            ->get();

        // Convertir a array y agregar el conteo de detalles
        $this->data = $receptions->map(function ($reception) {
            $receptionArray = $reception->toArray();
            $receptionArray['details_count'] = $reception->receptionDetails->count();
            return $receptionArray;
        })->toArray();

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

    public function print()
    {
        if (empty($this->selectedItems)) {
            session()->flash('message', 'Please select at least one item to print.');
            return;
        }
        
        return redirect()->route('printreception.data', [
            'items' => implode(',', $this->selectedItems),
        ]);
    }

    public function render()
    {
        return view('livewire.reports.receptions-report', [
            'data' => $this->data,
            'selectedItems' => $this->selectedItems,
            'selectAll' => $this->selectAll,
        ]);
    }
}