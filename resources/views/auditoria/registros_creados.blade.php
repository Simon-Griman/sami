@extends('adminlte::page')

@section('title', 'Sesiones')

@section('css')
    <style>
        td, th{
            width: 11.11%;
        }
    </style>
@stop

@section('content')
    @livewireStyles
    <img src="{{ url('storage/' . $cintillo) }}" alt="" class="cintillo" style="width:100%">
    @livewire('auditoria.registros-creados')
    @livewireScripts
@stop