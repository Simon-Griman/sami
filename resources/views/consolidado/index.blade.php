@extends('adminlte::page')

@section('title', 'Consolidado')

@section('css')
    <link rel="stylesheet" href="{{ url('css/toastr.css') }}">
@stop

@section('content')
    @livewireStyles

    {{-- <img src="{{ url('storage/' . $cintillo) }}" alt="" class="cintillo" style="width:100%"> --}}
    
    
    <div class="text-center">
        <a href="{{ route('consolidado.create') }}" class="btn btn-success mt-2">Nuevo Registro</a>
    </div>
    

    @livewire('consolidado.index')
    @livewireScripts
@stop