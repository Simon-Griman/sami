@extends('adminlte::page')

@section('title', 'Sesiones')

@section('content')
    @livewireStyles
    <img src="{{ url('storage/' . $cintillo) }}" alt="" class="cintillo" style="width:100%">
    @livewire('auditoria.sesion')
    @livewireScripts
@stop