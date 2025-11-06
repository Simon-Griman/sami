@extends('adminlte::page')

@section('title', 'Inicio')

@section('content')
    @livewireStyles
    <img src="{{ url('storage/' . $cintillo) }}" alt="" class="cintillo" style="width:100%">
    <br><br>
    @can('nuevo_usuario')
        @livewire('nuevo-usuario')
    @endcan

    @can('mis_equipos')
    
    @endcan
    @livewireScripts
@stop