@extends('layouts.app')

@section('title', 'Reporte Despachos')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Reporte Despachos</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <livewire:reports.expedition-report />
    </div>
@endsection