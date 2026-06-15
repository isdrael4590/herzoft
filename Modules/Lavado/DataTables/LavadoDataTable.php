<?php

namespace Modules\Lavado\DataTables;

use Modules\Lavado\Entities\Lavado;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class LavadoDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('dates', function ($data) {
                return view('lavado::partials.dates', compact('data'));
            })
            ->addColumn('status_indicador', function ($data) {
                return view('lavado::partials.status_indicador', compact('data'));
            })
            ->addColumn('status_ciclo', function ($data) {
                return view('lavado::partials.status_ciclo', compact('data'));
            })
            ->addColumn('detalles', function ($data) {
                return view('lavado::partials.detalles', compact('data'));
            })
            ->addColumn('action', function ($data) {
                return view('lavado::partials.actions', compact('data'));
            })
            ->rawColumns(['dates', 'status_indicador', 'detalles', 'action']);
    }

    public function query(Lavado $model)
    {
        return $model->newQuery()->with('lavadoDetalles');
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('lavados-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-md-3'l><'col-md-5 mb-2'B><'col-md-4'f>> .
                                'tr' .
                                <'row'<'col-md-5'i><'col-md-7 mt-2'p>>")
            ->parameters([
                'order' => [[2, 'desc']],
            ])
            ->buttons(
                Button::make('excel')->text('<i class="bi bi-file-earmark-excel-fill"></i> Excel'),
                Button::make('print')->text('<i class="bi bi-printer-fill"></i> Print'),
                Button::make('reset')->text('<i class="bi bi-x-circle"></i> Reset'),
                Button::make('reload')->text('<i class="bi bi-arrow-repeat"></i> Reload'),
            );
    }

    protected function getColumns()
    {
        return [
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->className('text-center align-middle'),

            Column::computed('dates')
                ->title('Fecha')
                ->className('text-center align-middle'),

            Column::make('reference')
                ->title('Referencia')
                ->className('text-center align-middle'),

            Column::computed('status_indicador')
                ->title('Estado')
                ->className('text-center align-middle'),

            Column::computed('status_ciclo')
                ->title('Ciclo')
                ->className('text-center align-middle'),

            Column::make('equipo')
                ->title('Equipo')
                ->className('text-center align-middle'),

            Column::make('lote')
                ->title('Lote')
                ->className('text-center align-middle'),

            Column::make('programa_lavado')
                ->title('Programa')
                ->className('text-center align-middle'),

            Column::make('temperatura')
                ->title('Temp. (°C)')
                ->className('text-center align-middle'),

            Column::make('operator')
                ->title('Operador')
                ->className('text-center align-middle'),

            Column::computed('detalles')
                ->title('Paquetes')
                ->exportable(false)
                ->printable(false)
                ->className('text-center align-middle'),

            Column::make('created_at')->visible(false),
        ];
    }

    protected function filename(): string
    {
        return 'Lavados_' . date('YmdHis');
    }
}
