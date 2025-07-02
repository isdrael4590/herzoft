<?php

namespace Modules\Preparation\DataTables;

use Illuminate\Validation\Rules\Can;
use Modules\Preparation\Entities\PreparationDetails;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PreparationDetailsDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)

            ->addColumn('dates', function ($data) {
                return view('preparation::partials.dates', compact('data'));
            })
            ->addColumn('dates2', function ($data) {
                return view('preparation::partials.dates2', compact('data'));
            })->addColumn('product_coming_zone', function ($data) {
                return view('preparation::partials.product_coming_zone', compact('data'));
            })
            ->addColumn('action2', function ($data) {
                return view('preparation::partials.actions2', compact('data'));
            });
    }

public function query(PreparationDetails $model)
{
    $query = $model->newQuery()->orderBy('product_quantity', 'desc');
    $user = auth()->user();
    
    // Check permissions instead of roles
    if ($user->can('access_admin') || $user->can('access_user_management')) {
        // Admin with all permission can see all receptions
        return $query;
    } elseif ($user->can('access_preparations')) {
        // Users with basic 'access_preparations' permission see only quantities > 0
        return $query->where('product_quantity', '>', 0);
    } else {
        // No permissions - return empty result
        return $query->whereRaw('1 = 0'); // This ensures no results are returned
    }
}



    public function html()
    {
        return $this->builder()
            ->setTableId('preparationDetails-table')

            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-md-3'l><'col-md-5 mb-2'B><'col-md-4'f>> .
                                'tr' .
                                <'row'<'col-md-5'i><'col-md-7 mt-2'p>>")
            ->parameters([
                'order' => [[5, 'desc']],
            ])
            ->buttons(
                Button::make('excel')
                    ->text('<i class="bi bi-file-earmark-excel-fill"></i> Excel'),
                Button::make('print')
                    ->text('<i class="bi bi-printer-fill"></i> Print'),
                Button::make('reset')
                    ->text('<i class="bi bi-x-circle"></i> Reset'),
                Button::make('reload')
                    ->text('<i class="bi bi-arrow-repeat"></i> Reload')
            );
    }

    protected function getColumns()
    {

        $user = auth()->user();
        $columns = [];
        if ($user->can('access_admin')) {
            $columns[] = Column::computed('id')
                ->title('id')
                ->className('text-center align-middle');
        }
        $columns[] = Column::computed('dates2')
            ->title('Fecha de Ingreso')
            ->className('text-center align-middle');
        $columns[] = Column::computed('product_name')
            ->title('Nombre del Producto')
            ->className('text-center align-middle')
            ->searchable(true); // Hacer searchable
        $columns[] = Column::computed('product_code')
            ->title('Código del Producto')
            ->className('text-center align-middle')
            ->searchable(true); // Hacer searchable
        $columns[] = Column::computed('product_quantity')
            ->title('Cantidad')
            ->className('text-center align-middle');
        $columns[] = Column::computed('product_coming_zone')
            ->title('Proveniente')
            ->className('text-center align-middle');
        $columns[] = Column::computed('product_area')
            ->title('Area')
            ->className('text-center align-middle')
            ->searchable(true); // Hacer searchable
        $columns[] = Column::computed('product_type_process')
            ->title('Tipo de Proceso')
            ->className('text-center align-middle');
        $columns[] = Column::computed('action2')
            ->exportable(false)
            ->printable(true)
            ->className('text-center align-middle');



        return $columns;
    }

    protected function filename(): string
    {
        return 'PreparationDetails_' . date('YmdHis');
    }
}
