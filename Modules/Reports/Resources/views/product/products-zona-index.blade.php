@extends('layouts.app')

@section('title', 'Reporte Productos')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Reporte Productos</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <livewire:reports.products-zona-report />
    </div>
@endsection