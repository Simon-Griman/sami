@extends('adminlte::page')

@section('title', 'Consolidado')

@section('css')
    <link rel="stylesheet" href="{{ url('css/toastr.css') }}">

    <style>
        /* Ocultamos el botón nativo de forma agresiva */
        .input-hidden-custom {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0; /* Lo hace invisible */
            cursor: pointer;
            z-index: 2; /* Se asegura de estar por encima de todo */
        }
    </style>
@stop

@section('content')
    @livewireStyles

    {{-- <img src="{{ url('storage/' . $cintillo) }}" alt="" class="cintillo" style="width:100%"> --}}
    

    @livewire('consolidado.create')
    @livewireScripts
@stop