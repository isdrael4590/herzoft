<?php

namespace Modules\Product\DataTables;

use Modules\Product\Entities\Product;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

use function PHPUnit\Framework\returnSelf;

class ProductDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($data) {
                return view('product::products.partials.actions', compact('data'));
            })
            ->addColumn('product_image', function ($data) {
                $url = $data->getFirstMediaUrl('images', 'thumb');
                return '<img src="' . $url . '" border="0" width="50" class="img-thumbnail" align="center"/>';
            })
            ->addColumn('area', function ($data) {
                return ($data->area);
            })
            ->addColumn('product_note', function ($data) {
                return ($data->product_note);
            })
            ->rawColumns(['product_image']);
    }

    public function query(Product $model)
    {
        return $model->newQuery()->with('category');
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('product-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-md-3'l><'col-md-5 mb-2'B><'col-md-4'f>> .
                                'tr' .
                                <'row'<'col-md-5'i><'col-md-7 mt-2'p>>")
            ->parameters([
                'order' => [[1, 'asc']],
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

        if ($user->can('edit_products')) {
            $columns[] = Column::computed('product_image')
                ->exportable(false)
                ->printable(false)
                ->className('text-center align-middle');

            $columns[] = Column::make('product_code')
                ->title('Código')
                ->className('text-center align-middle');

            $columns[] = Column::make('product_name')
                ->title('Nombre')
                ->className('text-center align-middle');

            $columns[] = Column::make('category.category_name')
                ->title('Area/Especialidad')
                ->className('text-center align-middle');

            $columns[] = Column::computed('product_type_process')
                ->title('Tipo Proceso')
                ->className('text-center align-middle');

            $columns[] = Column::computed('product_info')
                ->title('Info Paquete')
                ->className('text-center align-middle');
            $columns[] = Column::make('action')
                ->title('Acciones')
                ->className('text-center align-middle');
        }
        if ($user->can('access_admin')) {
            $columns[] = Column::computed('id')
                ->title('ID')
                ->className('text-center align-middle');
            $columns[] = Column::make('product_barcode_symbology')
                ->title('Simbolología barcode')
                ->className('text-center align-middle');

            $columns[] = Column::computed('product_patient')
                ->title('Paciente')
                ->className('text-center align-middle');

            $columns[] = Column::computed('area')
                ->title('Area')
                ->className('text-center align-middle');
            $columns[] = Column::computed('product_price')
                ->title('Precio')
                ->className('text-center align-middle');
            $columns[] = Column::computed('product_quantity')
                ->title('Cantidad')
                ->className('text-center align-middle');
            $columns[] = Column::computed('product_note')
                ->title('Nota')
                ->className('text-center align-middle');
        }


        return $columns;
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Product_' . date('YmdHis');
    }
}
