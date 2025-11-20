<div class="">
    <div class="row d-flex justify-content-center">
        <div class="card m-2" style="max-height: 70vh;">
            @can('resumen.fechas')
            <div class="card-head">
                <select class="form-control" wire:model.live="selectedYear">
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                    <option value="2026">2026</option>
                    <option value="2027">2027</option>
                    <option value="2028">2028</option>
                    <option value="2029">2029</option>
                    <option value="2030">2030</option>  
                </select>
                <select class="form-control" wire:model.live="selectedMonth">
                    <option value="1">Enero</option>
                    <option value="2">Febrero</option>
                    <option value="3">Marzo</option>
                    <option value="4">Abril</option>
                    <option value="5">Mayo</option>
                    <option value="6">Junio</option>
                    <option value="7">Julio</option>
                    <option value="8">Agosto</option>
                    <option value="9">Septiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>
                </select>
            </div>
            @endcan
            <div class="card-body overflow-auto">
                <table class="table table-responsive table-hover">
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
                        @foreach ($resumen_ubicacion as $ubicacion)
                        <tr>
                            <td>{{ $ubicacion->ubicacion }}</td>
                            <td>{{ $ubicacion->total_cantidad }}</td>
                            <td>{{ $ubicacion->certificados }}</td>
                            @php
                                $ano = $fecha->parse($ubicacion->fecha)->format('Y');
                                $mes = $fecha->parse($ubicacion->fecha)->format('m');
                            @endphp
                            <td>{{ round($ubicacion->total_cantidad / (($fecha->create($ano, $mes, 1)->daysInMonth) * 1000 ), 2)}}</td>
                            <td>{{ round($ubicacion->total_cantidad / 1000000, 2) }} </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @can('resumen.pdf')
            <div class="card-footer">
                <div class="text-center">
                    <a href="{{ route('resumen.pdf', ['selectedMonth' => $selectedMonth, 'selectedYear' => $selectedYear, 'tipo' => 'ubicacion']) }}" class="btn btn-danger" target="_blank">Generar Pdf</a>
                </div>
            </div>
            @endcan
        </div>

        <div class="card m-2" style="max-height: 70vh;">
            @can('resumen.fechas')
            <div class="card-head">
                <select class="form-control" wire:model.live="selectedYear2">
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                    <option value="2026">2026</option>
                    <option value="2027">2027</option>
                    <option value="2028">2028</option>
                    <option value="2029">2029</option>
                    <option value="2030">2030</option>  
                </select>
                <select class="form-control" wire:model.live="selectedMonth2">
                    <option value="1">Enero</option>
                    <option value="2">Febrero</option>
                    <option value="3">Marzo</option>
                    <option value="4">Abril</option>
                    <option value="5">Mayo</option>
                    <option value="6">Junio</option>
                    <option value="7">Julio</option>
                    <option value="8">Agosto</option>
                    <option value="9">Septiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>
                </select>
            </div>
            @endcan
            <div class="card-body overflow-auto">
                <table class="table table-responsive table-hover">
                    <thead>
                        <tr>
                            <th>Hidrocarburo</th>
                            <th>Barriles</th>
                            <th>Certificados</th>
                            <th>MBD</th>
                            <th>MMBLS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($resumen_producto as $producto)
                        <tr>
                            <td>{{ $producto->productos }}</td>
                            <td>{{ $producto->total_cantidad }}</td>
                            <td>{{ $producto->certificados }}</td>
                            @php
                                $ano = $fecha->parse($producto->fecha)->format('Y');
                                $mes = $fecha->parse($producto->fecha)->format('m');
                            @endphp
                            <td>{{ round($producto->total_cantidad / (($fecha->create($ano, $mes, 1)->daysInMonth) * 1000 ), 2)}}</td>
                            <td>{{ round($producto->total_cantidad / 1000000, 2) }} </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @can('resumen.pdf')
            <div class="card-footer">
                <div class="text-center">
                    <a href="{{ route('resumen.pdf', ['selectedMonth' => $selectedMonth, 'selectedYear' => $selectedYear, 'tipo' => 'producto']) }}" class="btn btn-danger" target="_blank">Generar Pdf</a>
                </div>
            </div>
            @endcan
        </div>
    </div>
</div>