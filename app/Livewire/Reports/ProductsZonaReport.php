<?php

namespace App\Livewire\Reports;

use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\WithPagination;

class ProductsZonaReport extends Component
{
    public $startDate;
    public $endDate;
    public $zona = 'all'; // all, reception, labelqr, discharge, expedition
    public $productName = '';
    public $productCode = '';
    public $data = [];
    public $selectedItems = [];
    public $selectAll = false;
    public $groupBy = 'product'; // product, zona, date

    // Reglas de validación
    protected function rules()
    {
        return [
            'productName' => 'required_without:productCode',
            'productCode' => 'required_without:productName',
        ];
    }

    // Mensajes personalizados
    protected $messages = [
        'productName.required_without' => 'Debe ingresar al menos el nombre o el código del producto.',
        'productCode.required_without' => 'Debe ingresar al menos el código o el nombre del producto.',
    ];

    public function mount()
    {
        $this->startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->endDate = Carbon::now()->format('Y-m-d');
        // No cargamos datos automáticamente, esperamos que el usuario busque
    }

    public function loadData()
    {
        // Validar antes de cargar datos
        $this->validate();

        try {
            $this->data = [];

            // Recopilar datos de cada área
            if ($this->zona === 'all' || $this->zona === 'reception') {
                $this->data = array_merge($this->data, $this->getReceptionData());
            }

            if ($this->zona === 'all' || $this->zona === 'labelqr') {
                $this->data = array_merge($this->data, $this->getLabelQrData());
            }

            if ($this->zona === 'all' || $this->zona === 'discharge') {
                $this->data = array_merge($this->data, $this->getDischargeData());
            }

            if ($this->zona === 'all' || $this->zona === 'expedition') {
                $this->data = array_merge($this->data, $this->getExpeditionData());
            }

            // Agrupar datos según selección
            $this->data = $this->groupData($this->data);

            // Seleccionar todos por defecto
            $this->selectedItems = collect($this->data)
                ->pluck('id')
                ->map(fn($id) => (string) $id)
                ->toArray();
            $this->selectAll = true;

            if (count($this->data) > 0) {
                session()->flash('message', 'Cargados ' . count($this->data) . ' registros.');
            } else {
                session()->flash('warning', 'No se encontraron registros con los criterios especificados.');
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Dejar que Livewire maneje la validación
            throw $e;
        } catch (\Exception $e) {
            // Se muestra el error exacto de la base de datos
            session()->flash('error', 'Error cargando datos: ' . $e->getMessage());
            $this->data = [];
        }
    }

    // Validación en tiempo real (opcional)
    public function updated($propertyName)
    {
        if (in_array($propertyName, ['productName', 'productCode'])) {
            $this->validateOnly($propertyName);
        }
    }

    /**
     * Obtiene los datos de recepción de la base de datos.
     * Se corrigió la referencia a 'r.supplier_name'.
     * @return array
     */
    private function getReceptionData()
    {
        $query = DB::table('receptions as r')
            ->join('reception_details as rd', 'r.id', '=', 'rd.reception_id')
            ->whereBetween('r.updated_at', [
                $this->startDate . ' 00:00:00',
                $this->endDate . ' 23:59:59',
            ])
            ->when($this->productName, function ($query) {
                return $query->where('rd.product_name', 'like', '%' . $this->productName . '%');
            })
            ->when($this->productCode, function ($query) {
                return $query->where('rd.product_code', $this->productCode);
            })
            ->select(
                'r.id as main_id',
                'rd.id as detail_id',
                'r.reference',
                'r.updated_at as date',
                'rd.product_name',
                'rd.product_code',
                DB::raw("'reception' as area"),
                DB::raw("'Recepción' as area_name"),
                DB::raw("'reception' as zona"),
                DB::raw("'Recepción' as zona_name"),
                DB::raw("'N/A' as provider_name"),
                'rd.product_quantity as quantity'
            )
            ->get()
            ->toArray();

        return array_map(function ($item) {
            $item->id = 'reception_' . $item->detail_id;
            return (array) $item;
        }, $query);
    }

    private function getLabelQrData()
    {
        $query = DB::table('labelqrs as l')
            ->join('labelqr_details as ld', 'l.id', '=', 'ld.labelqr_id')
            ->whereBetween('l.updated_at', [
                $this->startDate . ' 00:00:00',
                $this->endDate . ' 23:59:59',
            ])
            ->when($this->productName, function ($query) {
                return $query->where('ld.product_name', 'like', '%' . $this->productName . '%');
            })
            ->when($this->productCode, function ($query) {
                return $query->where('ld.product_code', $this->productCode);
            })
            ->select(
                'l.id as main_id',
                'ld.id as detail_id',
                'l.reference',
                'l.updated_at as date',
                'ld.product_name',
                'ld.product_code',
                DB::raw("'labelqr' as area"),
                DB::raw("'Etiquetado QR' as area_name"),
                DB::raw("'labelqr' as zona"),
                DB::raw("'Etiquetado QR' as zona_name"),
                DB::raw("'N/A' as provider_name"),
                'ld.product_quantity as quantity'
            )
            ->get()
            ->toArray();

        return array_map(function ($item) {
            $item->id = 'labelqr_' . $item->detail_id;
            return (array) $item;
        }, $query);
    }

    private function getDischargeData()
    {
        $query = DB::table('discharges as d')
            ->join('discharge_details as dd', 'd.id', '=', 'dd.discharge_id')
            ->whereBetween('d.updated_at', [
                $this->startDate . ' 00:00:00',
                $this->endDate . ' 23:59:59',
            ])
            ->when($this->productName, function ($query) {
                return $query->where('dd.product_name', 'like', '%' . $this->productName . '%');
            })
            ->when($this->productCode, function ($query) {
                return $query->where('dd.product_code', $this->productCode);
            })
            ->select(
                'd.id as main_id',
                'dd.id as detail_id',
                'd.reference',
                'd.updated_at as date',
                'dd.product_name',
                'dd.product_code',
                DB::raw("'discharge' as area"),
                DB::raw("'Descarga' as area_name"),
                DB::raw("'discharge' as zona"),
                DB::raw("'Descarga' as zona_name"),
                DB::raw("'N/A' as provider_name"),
                'dd.product_quantity as quantity'
            )
            ->get()
            ->toArray();

        return array_map(function ($item) {
            $item->id = 'discharge_' . $item->detail_id;
            return (array) $item;
        }, $query);
    }

    private function getExpeditionData()
    {
        $query = DB::table('expeditions as e')
            ->join('expedition_details as ed', 'e.id', '=', 'ed.expedition_id')
            ->whereBetween('e.updated_at', [
                $this->startDate . ' 00:00:00',
                $this->endDate . ' 23:59:59',
            ])
            ->when($this->productName, function ($query) {
                return $query->where('ed.product_name', 'like', '%' . $this->productName . '%');
            })
            ->when($this->productCode, function ($query) {
                return $query->where('ed.product_code', $this->productCode);
            })
            ->select(
                'e.id as main_id',
                'ed.id as detail_id',
                'e.reference',
                'e.updated_at as date',
                'ed.product_name',
                'ed.product_code',
                DB::raw("'expedition' as area"),
                DB::raw("'Expedición' as area_name"),
                DB::raw("'expedition' as zona"),
                DB::raw("'Expedición' as zona_name"),
                DB::raw("'N/A' as provider_name"),
                'ed.product_quantity as quantity'
            )
            ->get()
            ->toArray();

        return array_map(function ($item) {
            $item->id = 'expedition_' . $item->detail_id;
            return (array) $item;
        }, $query);
    }

    private function groupData($data)
    {
        $collection = collect($data);

        switch ($this->groupBy) {
            case 'product':
                return $collection->groupBy('product_name')->map(function ($items, $productName) {
                    return [
                        'id' => 'product_' . md5($productName),
                        'product_name' => $productName,
                        'product_code' => $items->first()['product_code'] ?? 'N/A',
                        'total_quantity' => $items->sum('quantity'),
                        'zonas_count' => $items->pluck('zona')->unique()->count(),
                        'records_count' => $items->count(),
                        'zonas' => $items->pluck('zona_name')->unique()->implode(', '),
                        'items' => $items->toArray(),
                    ];
                })->values()->toArray();

            case 'zona':
                return $collection->groupBy('zona')->map(function ($items, $zona) {
                    return [
                        'id' => 'zona_' . $zona,
                        'zona' => $zona,
                        'zona_name' => $items->first()['zona_name'],
                        'total_quantity' => $items->sum('quantity'),
                        'products_count' => $items->pluck('product_name')->unique()->count(),
                        'records_count' => $items->count(),
                        'items' => $items->toArray(),
                    ];
                })->values()->toArray();

            case 'date':
                return $collection->groupBy(function ($item) {
                    return Carbon::parse($item['date'])->format('Y-m-d');
                })->map(function ($items, $date) {
                    return [
                        'id' => 'date_' . $date,
                        'date' => $date,
                        'total_quantity' => $items->sum('quantity'),
                        'products_count' => $items->pluck('product_name')->unique()->count(),
                        'zonas_count' => $items->pluck('zona')->unique()->count(),
                        'records_count' => $items->count(),
                        'items' => $items->toArray(),
                    ];
                })->values()->toArray();

            default:
                return $data;
        }
    }

    public function selectByzona($zonaName)
    {
        if ($zonaName === 'All') {
            $this->selectedItems = collect($this->data)
                ->pluck('id')
                ->map(fn($id) => (string) $id)
                ->toArray();
        } else {
            $this->selectedItems = collect($this->data)
                ->where('zona', $zonaName)
                ->pluck('id')
                ->map(fn($id) => (string) $id)
                ->toArray();
        }

        $this->selectAll = count($this->selectedItems) === count($this->data);
        session()->flash('message', 'Seleccionados ' . count($this->selectedItems) . ' elementos');
    }

    public function print()
    {
        if (empty($this->selectedItems)) {
            session()->flash('error', 'Por favor seleccione al menos un elemento.');
            return;
        }

        try {
            Session::put('print_products_zona_items', $this->selectedItems);
            Session::put('print_products_zona_data', $this->data);
            Session::put('print_products_zona_timestamp', now());

            return redirect()->route('reports.product.products-zona.print');
        } catch (\Exception $e) {
            session()->flash('error', 'Error preparando impresión: ' . $e->getMessage());
        }
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedItems = collect($this->data)
                ->pluck('id')
                ->map(fn($id) => (string) $id)
                ->toArray();
        } else {
            $this->selectedItems = [];
        }
    }

    public function getSelectedCountProperty()
    {
        return count($this->selectedItems);
    }

    public function getTotalQuantityProperty()
    {
        return collect($this->data)
            ->whereIn('id', $this->selectedItems)
            ->sum('total_quantity');
    }

    public function render()
    {
        return view('livewire.reports.products-zona-report');
    }
}