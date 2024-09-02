<?php

namespace Modules\Preparation\DataTables;

use Modules\Preparation\Entities\Preparation;
use Modules\Preparation\Entities\Preparationze;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PreparationDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)

            ->addColumn('action', function ($data) {
                return view('preparation::partials.actions', compact('data'));
            })
            ->addColumn('dates', function ($data) {
                return view('preparation::partials.dates', compact('data'));
            });
      

    }

    public function query(Preparation $model, Preparationze $model2)
    {
        return $model->newQuery();
        return $model2->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('preparations-table')
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

            Column::make('dates')
                ->title('Fecha')
                ->className('text-center align-middle'),

            Column::make('reference')
                ->title('Referencia')
                ->className('text-center align-middle'),
            Column::make('note')
                ->title('Notas')
                ->className('text-center align-middle'),
            Column::make('operator')
                ->title('Operador')
                ->className('text-center align-middle'),
  

        ];
    }

    protected function filename(): string
    {
        return 'preparation_' . date('YmdHis');
    }
}
