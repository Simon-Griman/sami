<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Resumen {{ $tipo }}: @if ($tipo == 'ubicacion') {{ $mes_ubicacion }}-{{ $ano_ubicacion }} @else {{ $mes_producto }}-{{ $ano_producto }} @endif</title>
    <style>
        <?php include(public_path().'/css/estilos.css');?>
    </style>
</head>
<body>
    <img src="{{ url('storage/' . $cintillo) }}" alt="" class="cintillo" style="width:100%">
    <div class="row d-flex justify-content-center">
        <h1>Resumen Consolidado {{ $mes_ubicacion }}/{{ $ano_ubicacion }}</h1>
        <div class="card mt-2" style="max-height: 70vh;">
            <div class="card-body overflow-auto">
                <table class="table table-responsive table-hover tabla">
                    <thead>
                        <tr>
                            <th>Ubicación</th>
                            <th>Barriles</th>
                            <th>Certificados</th>
                            <th>MBD</th>
                            <th>MMBLS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($resumen as $item)
                        <tr>
                            @if ($tipo == 'ubicacion')
                            <td>{{ $item->ubicacion }}</td>
                            @else
                            <td>{{ $item->producto }}</td>
                            @endif
                            <td>{{ $item->total_cantidad }}</td>
                            <td>{{ $item->certificados }}</td>
                            @php
                                $ano = $fecha->parse($item->fecha)->format('Y');
                                $mes = $fecha->parse($item->fecha)->format('m');
                            @endphp
                            <td>{{ round($item->total_cantidad / (($fecha->create($ano, $mes, 1)->daysInMonth) * 1000 ), 2)}}</td>
                            <td>{{ round($item->total_cantidad / 1000000, 2) }} </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>