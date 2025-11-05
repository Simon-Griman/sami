@extends('adminlte::page')

@section('title', 'Usuarios')

@section('css')
    <link rel="stylesheet" href="{{ url('css/toastr.css') }}">
@stop

@section('content')
    @livewireStyles
    @if (session('info'))
    @section('js')
        <script>
            toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-bottom-right",
            }

            Command: toastr["info"]("{{ session('info') }}", "Hecho");
        </script>
    @stop
    @endif

    {{-- <img src="{{ url('storage/' . $cintillo) }}" alt="" class="cintillo" style="width:100%">
    <br><br> --}}
    
    @can('users.create')
        <div class="text-center p-2">
            <a href="{{ route('users.create') }}" class="btn btn-primary">Nuevo Usuario</a>
        </div>
    @endcan

    @livewire('user.index')
    @livewireScripts
@stop