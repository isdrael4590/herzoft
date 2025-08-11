<?php

namespace App\Livewire\Reports;

use Livewire\Component;
use Carbon\Carbon;
use Livewire\WithPagination;
use Modules\Reception\Entities\Reception;
use Illuminate\Support\Facades\Session;

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
        try {
            // MODIFICACIÓN: Incluir receptionDetails en la consulta para obtener product_name
            $receptions = Reception::with(['receptionDetails' => function($query) {
                    $query->select('reception_id', 'product_name'); // Seleccionar campos necesarios
                }])
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

            // MODIFICACIÓN: Incluir product_names en el mapeo
            $this->data = $receptions->map(function ($reception) {
                $receptionArray = $reception->toArray();
                $receptionArray['details_count'] = $reception->receptionDetails->count();
                
                // *** NUEVA FUNCIONALIDAD: Agregar los nombres de productos ***
                $receptionArray['product_names'] = $reception->receptionDetails
                    ->pluck('product_name')
                    ->filter() // Eliminar valores vacíos o null
                    ->unique() // Eliminar duplicados
                    ->values()
                    ->toArray();
                
                // También agregar una cadena concatenada para mostrar fácilmente
                $receptionArray['product_names_string'] = implode(', ', $receptionArray['product_names']);
                
                return $receptionArray;
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
            Session::put('print_reception_items', $this->selectedItems);
            Session::put('print_reception_timestamp', now());

            \Log::info('Items guardados en sesión para impresión: ' . count($this->selectedItems));

            // Redirigir directamente al controlador
            return redirect()->route('reports.reception.print-session');
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
        Session::put('print_reception_chunks', $chunks);
        Session::put('print_reception_total_items', $itemCount);
        Session::put('print_reception_timestamp', now());

        \Log::info("Items divididos en {count($chunks)} chunks para impresión total: {$itemCount}");

        // Procesar el primer chunk
        return redirect()->route('reports.reception.print-chunks');
    }

    // MÉTODO DIRECTO - Sin JavaScript, directo por servidor
    public function printDirect()
    {
        if (empty($this->selectedItems)) {
            session()->flash('message', 'Por favor seleccione al menos un elemento para imprimir.');
            return;
        }

        try {
            // MODIFICACIÓN: Incluir receptionDetails con product_name para la impresión
            $receptions = Reception::with(['receptionDetails' => function($query) {
                    $query->select('reception_id', 'product_name', 'quantity');
                }])
                ->whereIn('id', $this->selectedItems)
                ->orderBy('updated_at', 'desc')
                ->get();

            if ($receptions->isEmpty()) {
                session()->flash('message', 'No se encontraron elementos válidos para imprimir.');
                return;
            }

            // Usar el controlador para generar el PDF
            $controller = new \Modules\Reports\Http\Controllers\ReceptionPrintController();
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
                ->where('status', $status)
                ->pluck('id')
                ->map(fn($id) => (string) $id)
                ->toArray();

            $this->selectAll = count($this->selectedItems) === count($this->data);

            session()->flash('message', 'Selected ' . count($this->selectedItems) . ' items with status: ' . $status);
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
        return view('livewire.reports.receptions-report', [
            'data' => $this->data,
            'selectedItems' => $this->selectedItems,
            'selectAll' => $this->selectAll,
        ]);
    }
}