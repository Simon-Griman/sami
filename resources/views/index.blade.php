@extends('adminlte::page')

@section('title', 'Inicio')

@section('content')
    @livewireStyles
    <img src="{{ url('storage/' . $cintillo) }}" alt="" class="cintillo" style="width:100%">

    @livewireScripts
@stop