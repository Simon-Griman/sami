@extends('adminlte::page')

@section('title', 'Inicio')

@section('content')
    @livewireStyles
    <img src="{{ url('storage/' . $cintillo) }}" alt="" class="cintillo" style="width:100%">

    <h2 class="text-center mt-2">Bienvenido {{ $name }}</h2>

    @livewire('inicio')

    @livewireScripts
@stop