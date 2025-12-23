<?php

namespace Modules\Product\DataTables;

use Modules\Product\Entities\Instrumental;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class InstrumentalDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($data) {
                return view('product::instrumental.partials.actions', compact('data'));
            })
            ->addColumn('product_name', function ($data) {
                if ($data->product) {
                    return '<span class="badge badge-info">' . $data->product->product_name . '</span>';
                }
                return '<span class="badge badge-secondary">Sin Paquete</span>';
            })
            ->addColumn('estado_badge', function ($data) {
                $badges = [
                    'DISPONIBLE' => 'success',
                    'EN USO' => 'primary',
                    'MANTENIMIENTO' => 'warning',
                    'BAJA' => 'danger',
                ];
                $color = $badges[$data->estado_actual] ?? 'secondary';
                return '<span class="badge badge-' . $color . '">' . str_replace('_', ' ', $data->estado_actual) . '</span>';
            })
            ->addColumn('fecha_compra_formatted', function ($data) {
                return $data->fecha_compra ? $data->fecha_compra->format('d/m/Y') : 'N/A';
            })
            ->filterColumn('product_name', function ($query, $keyword) {
                $query->whereHas('product', function ($q) use ($keyword) {
                    $q->where('product_name', 'like', "%{$keyword}%");
                });
            })
            ->rawColumns(['action', 'product_name', 'estado_badge']);
    }

    public function query(Instrumental $model)
    {
        return $model->newQuery()->with('product');
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('instrumental-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-md-3'l><'col-md-5 mb-2'B><'col-md-4'f>> .
                                'tr' .
                                <'row'<'col-md-5'i><'col-md-7 mt-2'p>>")
            ->parameters([
                'order' => [[0, 'desc']], // Ordenar por ID descendente
            ])
            ->buttons(
                Button::make('create')
                    ->text('<i class="bi bi-plus-circle"></i> Crear Instrumental')
                    ->addClass('btn btn-primary'),
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
                ->title('ID')
                ->className('text-center align-middle')
                ->width(60),
            Column::computed('product_id')
                ->title('Product ID')
                ->className('text-center align-middle')
                ->orderable(true)
                ->searchable(true),

            Column::computed('product_name')
                ->title('Paquete')
                ->className('text-center align-middle')
                ->orderable(true)
                ->searchable(true)
                ->width(200),

            Column::make('codigo_unico_ud')
                ->title('Código Único')
                ->className('text-center align-middle')
                ->width(120),

            Column::make('nombre_generico')
                ->title('Descripción')
                ->className('align-middle')
                ->width(250),

            Column::make('tipo_familia')
                ->title('Familia')
                ->className('text-center align-middle')
                ->width(150),

            Column::make('marca_fabricante')
                ->title('Fabricante')
                ->className('text-center align-middle')
                ->width(150),

            Column::computed('fecha_compra_formatted')
                ->title('Fecha de Compra')
                ->className('text-center align-middle')
                ->orderable(false)
                ->width(120),

            Column::computed('estado_badge')
                ->title('Estado')
                ->className('text-center align-middle')
                ->orderable(false)
                ->width(130),

            Column::make('created_at')
                ->title('Fecha Creación')
                ->className('text-center align-middle')
                ->visible(false),

            Column::computed('action')
                ->title('Acciones')
                ->exportable(false)
                ->printable(false)
                ->className('text-center align-middle')
                ->width(100),
        ];
    }

    protected function filename(): string
    {
        return 'Instrumental_' . date('YmdHis');
    }
}
