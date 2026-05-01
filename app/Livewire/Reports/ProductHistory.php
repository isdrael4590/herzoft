<?php

namespace App\Livewire\Reports;

use Livewire\Component;
use Carbon\Carbon;
use Livewire\WithPagination;
use Modules\Reception\Entities\ReceptionDetails;
use Modules\Informat\Entities\Area;

class ProductHistory extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $startDate;
    public $endDate;
    public $searchName = '';
    public $searchCode = '';
    public $filterArea = '';
    public $filterCasaComercial = '';
    public $filterTipoDirt = '';
    public $filterEstado = '';
    public $areas = [];

    public function mount()
    {
        $this->startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->endDate = Carbon::now()->format('Y-m-d');
        $this->loadAreas();
    }

    public function loadAreas()
    {
        try {
            $this->areas = Area::orderBy('name')->get();
        } catch (\Exception $e) {
            $this->areas = collect([]);
        }
    }

    public function updatingSearchName()
    {
        $this->resetPage();
    }

    public function updatingSearchCode()
    {
        $this->resetPage();
    }

    public function updatingFilterArea()
    {
        $this->resetPage();
    }

    public function updatingFilterCasaComercial()
    {
        $this->resetPage();
    }

    public function updatingFilterTipoDirt()
    {
        $this->resetPage();
    }

    public function updatingFilterEstado()
    {
        $this->resetPage();
    }

    public function search()
    {
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->searchName = '';
        $this->searchCode = '';
        $this->filterArea = '';
        $this->filterCasaComercial = '';
        $this->filterTipoDirt = '';
        $this->filterEstado = '';
        $this->startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->endDate = Carbon::now()->format('Y-m-d');
        $this->resetPage();
    }

    public function getHistoryProperty()
    {
        $query = ReceptionDetails::with(['reception' => function ($q) {
                $q->select('id', 'reference', 'area', 'area_id', 'operator', 'delivery_staff', 'status', 'created_at', 'updated_at');
            }])
            ->whereHas('reception', function ($q) {
                $q->whereBetween('created_at', [
                    $this->startDate . ' 00:00:00',
                    $this->endDate . ' 23:59:59',
                ]);

                if ($this->filterArea) {
                    $q->where('area', $this->filterArea);
                }

                if ($this->filterEstado) {
                    $q->where('status', $this->filterEstado);
                }
            });

        if ($this->searchName) {
            $query->where('product_name', 'like', '%' . $this->searchName . '%');
        }

        if ($this->searchCode) {
            $query->where('product_code', 'like', '%' . $this->searchCode . '%');
        }

        if ($this->filterCasaComercial) {
            $query->where('product_outside_company', 'like', '%' . $this->filterCasaComercial . '%');
        }

        if ($this->filterTipoDirt) {
            $query->where('product_type_dirt', $this->filterTipoDirt);
        }

        return $query->orderByDesc('created_at')->paginate(20);
    }

    public function getTotalQuantityProperty()
    {
        $query = ReceptionDetails::whereHas('reception', function ($q) {
                $q->whereBetween('created_at', [
                    $this->startDate . ' 00:00:00',
                    $this->endDate . ' 23:59:59',
                ]);

                if ($this->filterArea) {
                    $q->where('area', $this->filterArea);
                }

                if ($this->filterEstado) {
                    $q->where('status', $this->filterEstado);
                }
            });

        if ($this->searchName) {
            $query->where('product_name', 'like', '%' . $this->searchName . '%');
        }

        if ($this->searchCode) {
            $query->where('product_code', 'like', '%' . $this->searchCode . '%');
        }

        if ($this->filterCasaComercial) {
            $query->where('product_outside_company', 'like', '%' . $this->filterCasaComercial . '%');
        }

        if ($this->filterTipoDirt) {
            $query->where('product_type_dirt', $this->filterTipoDirt);
        }

        return $query->sum('product_quantity');
    }

    public function getTotalRecordsProperty()
    {
        return $this->history->total();
    }

    public function render()
    {
        return view('livewire.reports.product-history', [
            'history'       => $this->history,
            'totalQuantity' => $this->totalQuantity,
            'totalRecords'  => $this->totalRecords,
            'areas'         => $this->areas,
        ]);
    }
}
