@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content')
    @livewireStyles
    <br>
    @livewire('user.create')
    @livewireScripts
@stop