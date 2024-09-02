<?php

namespace Modules\Labelqr\DataTables;

use Modules\Labelqr\Entities\LabelqrDetails;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LabelqrDetailsDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('date_elaborates', function ($data) {
                return view('labelqr::partials.date_elaborates', compact('data'));
            })
            ->addColumn('date_expirations', function ($data) {
                return view('labelqr::partials.date_expirations', compact('data'));
            })
            ->addColumn('action2', function ($data) {
                return view('labelqr::partials.actions2', compact('data'));
            });
    }

    public function query(LabelqrDetails $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('labelqrdetails-table')

            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-md-3'l><'col-md-5 mb-2'B><'col-md-4'f>> .
                                'tr' .
                                <'row'<'col-md-5'i><'col-md-7 mt-2'p>>")
            ->parameters([
                'order' => [[0, 'desc']],
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

            Column::make('id')
                ->title('Indice')
                ->className('text-center align-middle'),
            Column::make('date_elaborates')
                ->title('Fecha Elaboración')
                ->className('text-center align-middle'),
            Column::make('date_expirations')
                ->title('Fecha expiración')
                ->className('text-center align-middle'),
            Column::make('product_name')
                ->title('Nombre del Producto')
                ->className('text-center align-middle'),
            Column::computed('product_code')
                ->title('Codigo del Producto')
                ->className('text-center align-middle'),
            Column::make('product_package_wrap')
                ->title('Tipo de Paquete')
                ->className('text-center align-middle'),
            Column::make('product_eval_package')
                ->title('Validación Paquete')
                ->className('text-center align-middle'),
            Column::make('product_eval_indicator')
                ->title('Tipo Indicador')
                ->className('text-center align-middle'),
            Column::make('product_type_process')
                ->title('Tipo de esterilización')
                ->className('text-center align-middle'),
            Column::make('product_ref_qr')
                ->title('Estado del Instrumental')
                ->className('text-center align-middle'),

            Column::computed('action2')
                ->exportable(false)
                ->printable(false)
                ->className('text-center align-middle'),



            Column::make('created_at')
                ->visible(false)
        ];
    }

    protected function filename(): string
    {
        return 'LalbelqrDetails_' . date('YmdHis');
    }
}
