<?php

namespace App\Livewire\Reports;

use Livewire\Component;
use Carbon\Carbon;
use Livewire\WithPagination;
use Modules\Discharge\Entities\Discharge;
use Modules\Discharge\Entities\DischargeDetails;
use Illuminate\Support\Facades\Session;

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
        try {
            $discharges = Discharge::with(['dischargeDetails' => function ($query) {
                $query->select('discharge_id', 'product_name'); // Seleccionar campos necesarios
            }])
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
                ->orderBy('updated_at', 'desc')
                ->get();

            $this->data = $discharges->map(function ($discharge) {
                $dischargeArray = $discharge->toArray();
                $dischargeArray['details_count'] = $discharge->dischargeDetails->count();

                $dischargeArray['product_names'] = $discharge->dischargeDetails
                    ->pluck('product_name')
                    ->filter() // Eliminar valores vacíos o null
                    ->unique() // Eliminar duplicados
                    ->values()
                    ->toArray();

                $dischargeArray['product_names_string'] = implode(', ', $dischargeArray['product_names']);
                return $dischargeArray;
            })->toArray();

            $this->selectedItems = collect($this->data)->pluck('id')->map(fn($id) => (string) $id)->toArray();
            $this->selectAll = true;

            session()->flash('message', 'Loaded ' . count($this->data) . ' records. All items selected by default.');
        } catch (\Exception $e) {
            session()->flash('message', 'Error loading data: ' . $e->getMessage());
            $this->data = [];
            $this->selectedItems = [];
            $this->selectAll = false;
        }
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedItems = collect($this->data)->pluck('id')->map(fn($id) => (string) $id)->toArray();
        } else {
            $this->selectedItems = [];
        }
    }

    public $maxPrintItems = 5000;

    // MÉTODO MEJORADO - Guardar en sesión en lugar de enviar por JavaScript
    public function print()
    {
        if (empty($this->selectedItems)) {
            session()->flash('message', 'Por favor seleccione al menos un elemento para imprimir.');
            return;
        }

        if (count($this->selectedItems) > $this->maxPrintItems) {
            session()->flash('message', "Demasiados elementos seleccionados. Por favor seleccione máximo {$this->maxPrintItems} elementos.");
            return;
        }

        try {
            // SOLUCIÓN 1: Guardar los IDs en la sesión
            Session::put('print_discharge_items', $this->selectedItems);
            Session::put('print_discharge_timestamp', now());

            \Log::info('Items guardados en sesión para impresión: ' . count($this->selectedItems));

            // Redirigir directamente al controlador
            return redirect()->route('reports.discharge.print-session');
        } catch (\Exception $e) {
            session()->flash('message', 'Error preparando la impresión: ' . $e->getMessage());
            \Log::error('Error en print(): ' . $e->getMessage());
        }
    }

    // MÉTODO ALTERNATIVO - División en chunks y procesamiento por lotes
    public function printInChunks()
    {
        if (empty($this->selectedItems)) {
            session()->flash('message', 'Por favor seleccione al menos un elemento para imprimir.');
            return;
        }

        $itemCount = count($this->selectedItems);
        $chunkSize = 1000; // Procesar de 1000 en 1000
        $chunks = array_chunk($this->selectedItems, $chunkSize);

        // Guardar todos los chunks en la sesión
        Session::put('print_discharge_chunks', $chunks);
        Session::put('print_discharge_total_items', $itemCount);
        Session::put('print_discharge_timestamp', now());

        \Log::info("Items divididos en " . count($chunks) . " chunks para impresión total: {$itemCount}");

        // Procesar el primer chunk
        return redirect()->route('reports.discharge.print-chunks');
    }

    // MÉTODO DIRECTO - Sin JavaScript, directo por servidor
    public function printDirect()
    {
        if (empty($this->selectedItems)) {
            session()->flash('message', 'Por favor seleccione al menos un elemento para imprimir.');
            return;
        }

        try {
            // Generar PDF directamente desde Livewire
            $discharges = Discharge::with('dischargeDetails')
                ->whereIn('id', $this->selectedItems)
                ->orderBy('updated_at', 'desc')
                ->get();

            if ($discharges->isEmpty()) {
                session()->flash('message', 'No se encontraron elementos válidos para imprimir.');
                return;
            }

            // Usar el controlador para generar el PDF
            $controller = new \Modules\Reports\Http\Controllers\DischargePrintController();
            return $controller->generatePdfDirect($this->selectedItems);
        } catch (\Exception $e) {
            session()->flash('message', 'Error generando PDF: ' . $e->getMessage());
            \Log::error('Error en printDirect(): ' . $e->getMessage());
        }
    }

    public function toggleSelection($itemId)
    {
        $itemId = (string) $itemId;

        if (in_array($itemId, $this->selectedItems)) {
            $this->selectedItems = array_values(array_filter($this->selectedItems, fn($id) => $id !== $itemId));
        } else {
            $this->selectedItems[] = $itemId;
        }

        $this->selectAll = count($this->selectedItems) === count($this->data);
    }

    public function selectByStatus($status)
    {
        if ($status === 'All') {
            // Seleccionar todos los elementos
            $this->selectedItems = collect($this->data)
                ->pluck('id')
                ->map(fn($id) => (string) $id)
                ->toArray();

            $this->selectAll = true;

            session()->flash('message', 'Selected all ' . count($this->selectedItems) . ' items');
        } else {
            // Seleccionar por estado específico (puedes usar status_cycle o validation_biologic)
            $this->selectedItems = collect($this->data)
                ->where('status_cycle', $status)
                ->pluck('id')
                ->map(fn($id) => (string) $id)
                ->toArray();

            $this->selectAll = count($this->selectedItems) === count($this->data);

            session()->flash('message', 'Selected ' . count($this->selectedItems) . ' items with status: ' . $status);
        }
    }

    public function selectByMachine($machine)
    {
        if ($machine === 'All') {
            // Seleccionar todos los elementos
            $this->selectedItems = collect($this->data)
                ->pluck('id')
                ->map(fn($id) => (string) $id)
                ->toArray();

            $this->selectAll = true;

            session()->flash('message', 'Selected all ' . count($this->selectedItems) . ' items');
        } else {
            // Seleccionar por máquina específica
            $this->selectedItems = collect($this->data)
                ->where('machine_name', $machine)
                ->pluck('id')
                ->map(fn($id) => (string) $id)
                ->toArray();

            $this->selectAll = count($this->selectedItems) === count($this->data);

            session()->flash('message', 'Selected ' . count($this->selectedItems) . ' items for machine: ' . $machine);
        }
    }

    public function selectByBiologic($biologic)
    {
        if ($biologic === 'All') {
            // Seleccionar todos los elementos
            $this->selectedItems = collect($this->data)
                ->pluck('id')
                ->map(fn($id) => (string) $id)
                ->toArray();

            $this->selectAll = true;

            session()->flash('message', 'Selected all ' . count($this->selectedItems) . ' items');
        } else {
            // Seleccionar por validación biológica específica
            $this->selectedItems = collect($this->data)
                ->where('validation_biologic', $biologic)
                ->pluck('id')
                ->map(fn($id) => (string) $id)
                ->toArray();

            $this->selectAll = count($this->selectedItems) === count($this->data);

            session()->flash('message', 'Selected ' . count($this->selectedItems) . ' items with biologic validation: ' . $biologic);
        }
    }

    public function getSelectedCountProperty()
    {
        return count($this->selectedItems);
    }

    public function getTotalPackagesProperty()
    {
        return collect($this->data)
            ->whereIn('id', $this->selectedItems)
            ->sum('details_count');
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
