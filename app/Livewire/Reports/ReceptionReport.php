<?php

namespace App\Livewire\Reports;

use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Modules\Reception\Entities\Reception;
use Modules\Informat\Entities\Area;

class ReceptionReport extends Component
{
    // Filtros
    public string $startDate    = '';
    public string $endDate      = '';
    public string $area         = '';
    public string $status       = '';
    public string $productName  = '';
    public string $productCode  = '';
    public string $groupBy      = 'date';

    // Datos y selección
    public array  $data          = [];
    public array  $selectedItems = [];
    public bool   $selectAll     = false;

    // Config
    public int $maxPrintItems = 10000;

    // Áreas para el filtro
    public mixed $areas = [];

    public function mount(): void
    {
        $this->startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->endDate   = Carbon::now()->format('Y-m-d');
        $this->areas     = Area::orderBy('area_name')->get();
        $this->loadData();
    }

    // ── Carga de datos ────────────────────────────────────────────────────────

    public function loadData(): void
    {
        try {
            $receptions = Reception::query()
                ->select(['id', 'updated_at', 'reference', 'area', 'delivery_staff', 'operator', 'status'])
                ->withCount('receptionDetails as details_count')
                ->with(['receptionDetails' => fn($q) =>
                    $q->select('reception_id', 'product_name')->distinct()
                ])
                ->whereBetween('updated_at', [
                    $this->startDate . ' 00:00:00',
                    $this->endDate   . ' 23:59:59',
                ])
                ->when($this->area,   fn($q) => $q->where('area',   $this->area))
                ->when($this->status, fn($q) => $q->where('status', $this->status))
                ->when($this->productName, fn($q) => $q->whereHas('receptionDetails',
                    fn($d) => $d->where('product_name', 'like', '%' . $this->productName . '%')
                ))
                ->when($this->productCode, fn($q) => $q->whereHas('receptionDetails',
                    fn($d) => $d->where('product_code', 'like', '%' . $this->productCode . '%')
                ))
                ->orderByDesc('updated_at')
                ->limit(1000)
                ->get();

            $this->data = $receptions->map(fn($r) => [
                'id'             => $r->id,
                'updated_at'     => (string) $r->updated_at,
                'reference'      => $r->reference,
                'area'           => $r->area,
                'delivery_staff' => $r->delivery_staff,
                'operator'       => $r->operator,
                'status'         => $r->status,
                'details_count'  => $r->details_count,
                'product_names'  => $r->receptionDetails->pluck('product_name')->filter()->values()->toArray(),
            ])->toArray();

            $this->selectedItems = array_map('strval', array_column($this->data, 'id'));
            $this->selectAll = true;

        } catch (\Throwable $e) {
            Log::error('ReceptionReport::loadData ' . $e->getMessage());
            session()->flash('error', 'Error al cargar los datos: ' . $e->getMessage());
            $this->data          = [];
            $this->selectedItems = [];
            $this->selectAll     = false;
        }
    }

    // ── Selección ─────────────────────────────────────────────────────────────

    public function updatedSelectAll(bool $value): void
    {
        $this->selectedItems = $value
            ? collect($this->data)->pluck('id')->map(fn($id) => (string) $id)->toArray()
            : [];
    }

    public function selectByStatus(string $status): void
    {
        if ($status === 'All') {
            $this->selectedItems = collect($this->data)
                ->pluck('id')->map(fn($id) => (string) $id)->toArray();
            $this->selectAll = true;
            return;
        }

        $this->selectedItems = collect($this->data)
            ->where('status', $status)
            ->pluck('id')->map(fn($id) => (string) $id)->toArray();
        $this->selectAll = count($this->selectedItems) === count($this->data);
    }

    // ── Propiedades computadas ─────────────────────────────────────────────────

    public function getSelectedCountProperty(): int
    {
        return count($this->selectedItems);
    }

    public function getTotalPackagesProperty(): int
    {
        return (int) collect($this->data)
            ->whereIn('id', array_map('intval', $this->selectedItems))
            ->sum('details_count');
    }

    // ── Imprimir ──────────────────────────────────────────────────────────────

    public function print(): mixed
    {
        if (empty($this->selectedItems)) {
            session()->flash('message', 'Seleccione al menos un elemento para imprimir.');
            return null;
        }

        if (count($this->selectedItems) > $this->maxPrintItems) {
            session()->flash('message', "Máximo {$this->maxPrintItems} elementos. Seleccionados: " . count($this->selectedItems));
            return null;
        }

        Session::put('print_reception_items',     $this->selectedItems);
        Session::put('print_reception_timestamp', now());
        Session::put('print_reception_groupby',   $this->groupBy);
        Session::put('print_reception_filters',   [
            'startDate'   => $this->startDate,
            'endDate'     => $this->endDate,
            'area'        => $this->area,
            'status'      => $this->status,
            'productName' => $this->productName,
            'productCode' => $this->productCode,
            'groupBy'     => $this->groupBy,
        ]);

        return redirect()->route('reports.reception.print-session');
    }

    // ── Render ────────────────────────────────────────────────────────────────

    public function render()
    {
        return view('livewire.reports.receptions-report', [
            'areas'       => $this->areas,
            'selectedSet' => array_flip($this->selectedItems),
        ]);
    }
}
