@extends('adminlte::page')

@section('title', 'Cintillos')

@section('css')
    <link rel="stylesheet" href="{{ url('css/toastr.css') }}">
@stop



@section('content')
    @livewireStyles
    <img src="{{ url('storage/' . $cintillo) }}" alt="" class="cintillo" style="width:100%">

    <div class="text-center mt-2">
        <a class="btn btn-primary" data-toggle="modal" data-target="#crear">Nuevo Cintillo</a>
    </div>  

    @livewire('cintillo')
    @livewireScripts
@stop