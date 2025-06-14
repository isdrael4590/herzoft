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
        return $model->newQuery();
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
                'order' => [[3, 'desc']],
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
        return [
       
            Column::make('dates')
                ->title('Fecha Ingreso')
                ->className('text-center align-middle'),

            Column::make('product_name')
                ->title('Nombre del producto')
                ->className('text-center align-middle'),
            Column::make('product_code')
                ->title('Código del producto')
                ->className('text-center align-middle'),
            Column::make('product_quantity')
                ->title('Cantidad')
                ->className('text-center align-middle'),
            Column::make('product_coming_zone')
                ->title('Proveniente')
                ->className('text-center align-middle'),
            Column::make('product_area')
                ->title('Area')
                ->className('text-center align-middle'),
                Column::make('product_type_process')
                ->title('Tipo de proceso')
                ->className('text-center align-middle'),
            Column::computed('action2')
                ->exportable(false)
                ->printable(true)
                ->className('text-center align-middle'),

        ];
    }

    protected function filename(): string
    {
        return 'PreparationDetails_' . date('YmdHis');
    }
}
