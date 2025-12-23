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
            ->addColumn('barcode', function ($data) {
                try {
                    // Check if the symbology requires digits only
                    $digitOnlySymbologies = ['UPCA', 'UPCE', 'EAN13', 'EAN8', 'EAN5', 'EAN2', 'MSI'];

                    if (in_array($data->product_barcode_symbology, $digitOnlySymbologies) && !ctype_digit($data->product_code)) {
                        return '<div class="col-md-12"><small class="text-muted">Invalid code for ' . $data->product_barcode_symbology . '</small></div>';
                    }

                    // Generate barcode
                    $barcode = \Milon\Barcode\Facades\DNS1DFacade::getBarCodeSVG(
                        $data->product_code,
                        $data->product_barcode_symbology,
                        2,
                        110
                    );

                    return '<div class="col-md-12">' . $barcode . '</div>';
                } catch (\Exception $e) {
                    // Return error message or fallback
                    return '<div class="col-md-12"><small class="text-danger">Barcode Error: ' . $e->getMessage() . '</small></div>';
                }
            })
            ->rawColumns(['product_image', 'barcode']);
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


        if ($user->can('access_admin')) {
            $columns[] = Column::computed('id')
                ->title('ID')
                ->className('text-center align-middle');
            $columns[] = Column::make('product_barcode_symbology')
                ->title('Simbolología barcode')
                ->className('text-center align-middle');


            $columns[] = Column::computed('area')
                ->title('Area')
                ->className('text-center align-middle');


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


            $columns[] = Column::computed('product_type_process')
                ->title('Tipo Proceso')
                ->className('text-center align-middle');

            // Add the barcode column
            $columns[] = Column::computed('barcode')
                ->title('Código de Barras')
                ->exportable(true)
                ->printable(true)
                ->className('text-center align-middle');

            $columns[] = Column::make('action')
                ->title('Acciones')
                ->exportable(false)
                ->printable(false)
                ->className('text-center align-middle');
        } else {
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

            $columns[] = Column::computed('product_type_process')
                ->title('Tipo Proceso')
                ->className('text-center align-middle');

            // Add the barcode column
            $columns[] = Column::computed('barcode')
                ->title('Código de Barras')
                ->exportable(true)
                ->printable(true)
                ->className('text-center align-middle');
            $columns[] = Column::make('action')
                ->title('Acciones')
                ->exportable(false)
                ->printable(false)
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
