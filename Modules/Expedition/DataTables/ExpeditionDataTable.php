<?php

namespace Modules\Expedition\DataTables;

use Modules\Expedition\Entities\Expedition;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ExpeditionDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)

            ->addColumn('status_expedition', function ($data) {
                return view('expedition::partials.status_expedition', compact('data'));
            })
            ->addColumn('dates', function ($data) {
                return view('expedition::partials.dates', compact('data'));
            })
            ->addColumn('action', function ($data) {
                return view('expedition::partials.actions', compact('data'));
            });
    }

    public function query(Expedition $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('Expeditions-table')

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
           


            Column::make('reference')
                ->title('Ref. Expedición')
                ->className('text-center align-middle'),

                Column::make('dates')
                ->title('Fecha de entrega')
                ->className('text-center align-middle'),
                
            Column::make('area_expedition')
                ->title('Area Despachada')
                ->className('text-center align-middle'),

            Column::make('staff_expedition')
                ->title('Persona Recibe')
                ->className('text-center align-middle'),

            Column::make('temp_ambiente')
                ->title('Temperatura ambiental')
                ->className('text-center align-middle'),

            Column::make('status_expedition')
                ->title('Estado de Despacho')
                ->className('text-center align-middle'),


            Column::make('note')
                ->title('Notas')
                ->className('text-center align-middle'),

            Column::make('operator')
                ->title('Operador')
                ->className('text-center align-middle'),

            Column::make('created_at')
                ->visible(false)
        ];
    }

    protected function filename(): string
    {
        return 'Expedition_' . date('YmdHis');
    }
}
