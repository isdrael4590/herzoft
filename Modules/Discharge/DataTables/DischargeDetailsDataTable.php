<?php

namespace Modules\Discharge\DataTables;

use Modules\Discharge\Entities\DischargeDetails;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DischargeDetailsDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)

            ->addColumn('action', function ($data) {
                return view('discharge::partials.actionDetails', compact('data'));
            });
    }

    public function query(DischargeDetails $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('dischargeDetails-table')

            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-md-3'l><'col-md-5 mb-2'B><'col-md-4'f>> .
                                'tr' .
                                <'row'<'col-md-5'i><'col-md-7 mt-2'p>>")
            ->parameters([
                'order' => [[1, 'desc']],
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
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->className('text-center align-middle'),

            Column::make('product_name')
                ->title('Nombre del producto')
                ->className('text-center align-middle'),
            Column::make('product_code')
                ->title('Código del producto')
                ->className('text-center align-middle'),


            Column::make('product_ref_qr')
                ->title('Referencia Estado')
                ->className('text-center align-middle'),

            Column::computed('product_eval_package')
                ->title('Validación Paquete')
                ->className('text-center align-middle'),

            Column::make('product_expiration')
                ->title('Fecha de expiración')

                ->className('text-center align-middle'),


            Column::make('created_at')
                ->visible(false)
        ];
    }

    protected function filename(): string
    {
        return 'DischargeDetails_' . date('YmdHis');
    }
}
