@extends('layouts.app')

@section('title', ' Envio Preparation')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('preparations.index') }}">Preparación</a></li>
        <li class="breadcrumb-item active">Editar</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @include('utils.alerts')
                        <form id="preparation-form" action="{{ route('preparations.update', $preparation) }}" method="POST">
                            @csrf
                            @method('patch')
                            <div class="form-row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="reference">Referencia <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="reference" required value="{{ $preparation->reference }}" readonly>
                                    </div>
                                </div>
                              

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Operador</label>
                                        <input class="form-control" type="text" id="operator" name="operator"
                                            placeholder= "{{ Auth::user()->name }}" value="{{ Auth::user()->name }}">
                                    </div>
                                </div>
                            </div>

                           <livewire:product-carttoPRE :cartInstance="'preparation'" :data="$preparation"/>



                            <div class="form-group">
                                <label for="note">Nota (Si se necesita)</label>
                                <textarea name="note" id="note" rows="5" class="form-control">{{ $preparation->note }}</textarea>
                            </div>

                          

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">
                                    Actualizar preparación<i class="bi bi-check"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
