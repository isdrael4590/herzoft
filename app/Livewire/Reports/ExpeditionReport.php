<?php

namespace App\Livewire\Reports;

use Livewire\Component;
use Carbon\Carbon;
use Livewire\WithPagination;
use Modules\Expedition\Entities\Expedition;
use Illuminate\Support\Facades\Session;

class ExpeditionReport extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $startDate;
    public $endDate;
    public $area_expedition;
    public $status_expedition;
    public $data = [];
    public $selectedItems = [];
    public $selectAll = false;

    public function mount()
    {
        $this->startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->endDate = Carbon::now()->format('Y-m-d');
        $this->area_expedition = '';
        $this->status_expedition = '';
        $this->loadData();
    }

    public function loadData()
    {
        try {
            // MODIFICACIÓN: Incluir expeditionDetails en la consulta para obtener product_name
            $expeditions = Expedition::with(['expeditionDetails' => function ($query) {
                $query->select('expedition_id', 'product_name'); // Seleccionar campos necesarios
            }])
                ->whereBetween('updated_at', [
                    $this->startDate . ' 00:00:00',
                    $this->endDate . ' 23:59:59',
                ])
                ->when($this->area_expedition, function ($query) {
                    return $query->where('area_expedition', $this->area_expedition);
                })
                ->when($this->status_expedition, function ($query) {
                    return $query->where('status_expedition', $this->status_expedition);
                })
                ->orderBy('updated_at', 'desc')
                ->get();

            // MODIFICACIÓN: Incluir product_names en el mapeo
            $this->data = $expeditions->map(function ($expedition) {
                $expeditionArray = $expedition->toArray();
                $expeditionArray['details_count'] = $expedition->expeditionDetails->count();

                // *** NUEVA FUNCIONALIDAD: Agregar los nombres de productos ***
                $expeditionArray['product_names'] = $expedition->expeditionDetails
                    ->pluck('product_name')
                    ->filter() // Eliminar valores vacíos o null
                    ->unique() // Eliminar duplicados
                    ->values()
                    ->toArray();

                // También agregar una cadena concatenada para mostrar fácilmente
                $expeditionArray['product_names_string'] = implode(', ', $expeditionArray['product_names']);

                return $expeditionArray;
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
            Session::put('print_expedition_items', $this->selectedItems);
            Session::put('print_expedition_timestamp', now());

            // \Log::info('Items guardados en sesión para impresión: ' . count($this->selectedItems));

            // Redirigir directamente al controlador
            return redirect()->route('reports.expedition.print-session');
        } catch (\Exception $e) {
            session()->flash('message', 'Error preparando la impresión: ' . $e->getMessage());
            // \Log::error('Error en print(): ' . $e->getMessage());
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
        Session::put('print_expedition_chunks', $chunks);
        Session::put('print_expedition_total_items', $itemCount);
        Session::put('print_expedition_timestamp', now());

        \Log::info("Items divididos en " . count($chunks) . " chunks para impresión total: {$itemCount}");

        // Procesar el primer chunk
        return redirect()->route('reports.expedition.print-chunks');
    }

    // MÉTODO DIRECTO - Sin JavaScript, directo por servidor
    public function printDirect()
    {
        if (empty($this->selectedItems)) {
            session()->flash('message', 'Por favor seleccione al menos un elemento para imprimir.');
            return;
        }

        try {
            // MODIFICACIÓN: Incluir expeditionDetails con product_name para la impresión
            $expeditions = Expedition::with(['expeditionDetails' => function ($query) {
                $query->select('expedition_id', 'product_name', 'quantity');
            }])
                ->whereIn('id', $this->selectedItems)
                ->orderBy('updated_at', 'desc')
                ->get();

            if ($expeditions->isEmpty()) {
                session()->flash('message', 'No se encontraron elementos válidos para imprimir.');
                return;
            }

            // Usar el controlador para generar el PDF
            $controller = new \Modules\Reports\Http\Controllers\ExpeditionPrintController();
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
            // Seleccionar por estado específico
            $this->selectedItems = collect($this->data)
                ->where('status_expedition', $status)
                ->pluck('id')
                ->map(fn($id) => (string) $id)
                ->toArray();

            $this->selectAll = count($this->selectedItems) === count($this->data);

            session()->flash('message', 'Selected ' . count($this->selectedItems) . ' items with status: ' . $status);
        }
    }

    public function selectByArea($area)
    {
        if ($area === 'All') {
            // Seleccionar todos los elementos
            $this->selectedItems = collect($this->data)
                ->pluck('id')
                ->map(fn($id) => (string) $id)
                ->toArray();

            $this->selectAll = true;

            session()->flash('message', 'Selected all ' . count($this->selectedItems) . ' items');
        } else {
            // Seleccionar por área específica
            $this->selectedItems = collect($this->data)
                ->where('area_expedition', $area)
                ->pluck('id')
                ->map(fn($id) => (string) $id)
                ->toArray();

            $this->selectAll = count($this->selectedItems) === count($this->data);

            session()->flash('message', 'Selected ' . count($this->selectedItems) . ' items for area: ' . $area);
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
        return view('livewire.reports.expeditions-report', [
            'data' => $this->data,
            'selectedItems' => $this->selectedItems,
            'selectAll' => $this->selectAll,
        ]);
    }
}
