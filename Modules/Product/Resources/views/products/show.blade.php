@extends('layouts.app')

@section('title', 'Product Details')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Base Datos RUMED</a></li>
        <li class="breadcrumb-item active">Detalles</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid mb-4">
        <div class="row mb-3">
            <div class="col-md-12">
                {!! \Milon\Barcode\Facades\DNS1DFacade::getBarCodeSVG(
                    $product->product_code,
                    $product->product_barcode_symbology,
                    2,
                    110,
                ) !!}
            </div>
        </div>
        <div class="row">
            <div class="col-lg-9">
                <div class="card h-100">
                    <div class="card-body">
                        <label for="">
                            <h2>PAQUETES DE INSTRUMENTAL</h2>
                        </label>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped mb-0">
                                <tr>
                                    <th>Código del producto</th>
                                    <td>{{ $product->product_code }}</td>
                                </tr>
                                <tr>
                                    <th>Barcode simbología</th>
                                    <td>{{ $product->product_barcode_symbology }}</td>
                                </tr>
                                <tr>
                                    <th>Nombre</th>
                                    <td>{{ $product->product_name }}</td>
                                </tr>
                                <tr>
                                    <th>Categoria</th>
                                    <td>{{ $product->category->category_name }}</td>
                                </tr>
                                <tr>
                                    <th>Área</th>
                                    <td>{{ $product->area }}</td>
                                </tr>
                                <tr>
                                    <th>Temperatura de Trabajo</th>
                                    <td>{{ $product->product_type_process }}</td>
                                </tr>
                                <tr>
                                    <th>Cantidad</th>
                                    <td>{{ $product->product_quantity }}</td>
                                </tr>
                                <tr>
                                    <th>Paciente (Solo casa comercial)</th>
                                    <td>{{ $product->product_patient ?? 'N/A'}}</td>
                                </tr>
                                <tr>
                                    <th>Note</th>
                                    <td>{{ $product->product_note ?? 'N/A' }}</td>
                                </tr>
                            </table>
                            <br>
                        </div>
                        @can('accces_subproduct')
                            <div>
                                <label for="">
                                    <h3>DETALLES DEL PAQUETE</h3>
                                </label>
                            </div>
                            <div class="table-responsive-sm">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="align-middle">Código del Instrumental</th>
                                            <th class="align-middle">Descripción</th>
                                            <th class="align-middle">Cantidad</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product->Subproduct as $item)
                                            <tr>
                                                <td class="align-middle">
                                                    {{ $item->subproduct_code }} <br>
                                                </td>
                                                <td class="align-middle">
                                                    {{ $item->subproduct_name }}

                                                </td>
                                                <td class="align-middle">
                                                    {{ $item->subproduct_quantity }}
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endcan
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="card h-100">
                    <div class="card-body">
                        @forelse($product->getMedia('images') as $media)
                            <img src="{{ $media->getUrl() }}" alt="Product Image" class="img-fluid img-thumbnail mb-2">
                        @empty
                            <img src="{{ $product->getFirstMediaUrl('images') }}" alt="Product Image"
                                class="img-fluid img-thumbnail mb-2">
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
