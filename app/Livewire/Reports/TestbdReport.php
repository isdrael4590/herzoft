<?php

namespace App\Livewire\Reports;

use Livewire\Component;
use Carbon\Carbon;
use Livewire\WithPagination;
use Modules\Testbd\Entities\Testbd;
use Illuminate\Support\Facades\Session;

class TestbdReport extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $startDate;
    public $endDate;
    public $machine_name;
    public $validation_bd;
    public $data = [];
    public $selectedItems = [];
    public $selectAll = false;

    public function mount()
    {
        $this->startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->endDate = Carbon::now()->format('Y-m-d');
        $this->machine_name = '';
        $this->validation_bd = '';
        $this->loadData();
    }

    public function loadData()
    {
        try {
            // Obtener los datos con posibles relaciones si las hay
            $testbds = Testbd::whereBetween('updated_at', [
                    $this->startDate . ' 00:00:00',
                    $this->endDate . ' 23:59:59',
                ])
                ->when($this->machine_name, function ($query) {
                    return $query->where('machine_name', $this->machine_name);
                })
                ->when($this->validation_bd, function ($query) {
                    return $query->where('validation_bd', $this->validation_bd);
                })
                ->orderBy('updated_at', 'desc')
                ->get();

            // Mapear los datos para incluir información adicional si es necesaria
            $this->data = $testbds->map(function ($testbd) {
                $testbdArray = $testbd->toArray();
                
                // Agregar campos calculados o información adicional aquí
                // Por ejemplo, si tienes relaciones o campos computados
                // $testbdArray['additional_field'] = $testbd->someRelation;
                
                return $testbdArray;
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
            // Guardar los IDs en la sesión
            Session::put('print_testbd_items', $this->selectedItems);
            Session::put('print_testbd_timestamp', now());

            \Log::info('Items guardados en sesión para impresión: ' . count($this->selectedItems));

            // Redirigir directamente al controlador
            return redirect()->route('reports.testbd.print-session');
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
        Session::put('print_testbd_chunks', $chunks);
        Session::put('print_testbd_total_items', $itemCount);
        Session::put('print_testbd_timestamp', now());

        \Log::info("Items divididos en " . count($chunks) . " chunks para impresión total: {$itemCount}");

        // Procesar el primer chunk
        return redirect()->route('reports.testbd.print-chunks');
    }

    // MÉTODO DIRECTO - Sin JavaScript, directo por servidor
    public function printDirect()
    {
        if (empty($this->selectedItems)) {
            session()->flash('message', 'Por favor seleccione al menos un elemento para imprimir.');
            return;
        }

        try {
            $testbds = Testbd::whereIn('id', $this->selectedItems)
                ->orderBy('updated_at', 'desc')
                ->get();

            if ($testbds->isEmpty()) {
                session()->flash('message', 'No se encontraron elementos válidos para imprimir.');
                return;
            }

            // Usar el controlador para generar el PDF
            $controller = new \Modules\Reports\Http\Controllers\TestbdPrintController();
            return $controller->generatePdfDirect($this->selectedItems);
        } catch (\Exception $e) {
            session()->flash('message', 'Error generando PDF: ' . $e->getMessage());
            \Log::error('Error en printDirect(): ' . $e->getMessage());
        }
    }

    // MÉTODO ORIGINAL MANTENIDO PARA COMPATIBILIDAD
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
            // Seleccionar por validación específica (equivalente al status en Reception)
            $this->selectedItems = collect($this->data)
                ->where('validation_bd', $status)
                ->pluck('id')
                ->map(fn($id) => (string) $id)
                ->toArray();

            $this->selectAll = count($this->selectedItems) === count($this->data);

            session()->flash('message', 'Selected ' . count($this->selectedItems) . ' items with validation: ' . $status);
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

            session()->flash('message', 'Selected ' . count($this->selectedItems) . ' items from machine: ' . $machine);
        }
    }

    public function getSelectedCountProperty()
    {
        return count($this->selectedItems);
    }

    public function getTotalItemsProperty()
    {
        return collect($this->data)
            ->whereIn('id', $this->selectedItems)
            ->count();
    }

    // Propiedades computadas específicas para Testbd si las necesitas
    public function getValidItemsCountProperty()
    {
        return collect($this->data)
            ->whereIn('id', $this->selectedItems)
            ->where('validation_bd', 'valid') // o el valor que uses para válidos
            ->count();
    }

    public function getInvalidItemsCountProperty()
    {
        return collect($this->data)
            ->whereIn('id', $this->selectedItems)
            ->where('validation_bd', 'invalid') // o el valor que uses para inválidos
            ->count();
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