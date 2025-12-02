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
                <select class="form-control" wire:model.live="selectedOperacion">
                    <option value="">-- Seleccionar --</option>
                    <option value="Recibo">Recibo</option>
                    <option value="Venta">Venta</option>
                    <option value="Despacho">Despacho</option>
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
                            <td>{{ $mbd = round($ubicacion->total_cantidad / (($fecha->create($ano, $mes, 1)->daysInMonth) * 1000 ), 2)}}</td>
                            <td>{{ $mmbls = round($ubicacion->total_cantidad / 1000000, 2) }} </td>
                        </tr>

                        @php
                            $total_barriles += $ubicacion->total_cantidad;
                            $total_certificados += $ubicacion->certificados;
                            $total_mbd += $mbd;
                            $total_mmbls += $mmbls;
                        @endphp

                        @endforeach
                        <tr>
                            <td class="font-weight-bold">Total:</td>
                            <td class="font-weight-bold">{{ $total_barriles }}</td>
                            <td class="font-weight-bold">{{ $total_certificados }}</td>
                            <td class="font-weight-bold">{{ $total_mbd }}</td>
                            <td class="font-weight-bold">{{ $total_mmbls }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @can('resumen.pdf')
            <div class="card-footer">
                <div class="text-center">
                    <a href="{{ route('resumen.pdf', ['selectedMonth' => $selectedMonth, 'selectedYear' => $selectedYear, 'tipo' => 'ubicacion', 'operacion' => $selectedOperacion]) }}" class="btn btn-danger" target="_blank">Generar Pdf</a>
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
                <select class="form-control" wire:model.live="selectedOperacion2">
                    <option value="">-- Seleccionar --</option>
                    <option value="Recibo">Recibo</option>
                    <option value="Venta">Venta</option>
                    <option value="Despacho">Despacho</option>
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
                            <td>{{ $mbd2 = round($producto->total_cantidad / (($fecha->create($ano, $mes, 1)->daysInMonth) * 1000 ), 2)}}</td>
                            <td>{{ $mmbls2 = round($producto->total_cantidad / 1000000, 2) }}</td>
                        </tr>
                        @php
                            $total_barriles2 += $producto->total_cantidad;
                            $total_certificados2 += $producto->certificados;
                            $total_mbd2 += $mbd2;
                            $total_mmbls2 += $mmbls2;
                        @endphp
                        @endforeach
                        <tr>
                            <td class="font-weight-bold">Total:</td>
                            <td class="font-weight-bold">{{ $total_barriles2 }}</td>
                            <td class="font-weight-bold">{{ $total_certificados2 }}</td>
                            <td class="font-weight-bold">{{ $total_mbd2 }}</td>
                            <td class="font-weight-bold">{{ $total_mmbls2 }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @can('resumen.pdf')
            <div class="card-footer">
                <div class="text-center">
                    <a href="{{ route('resumen.pdf', ['selectedMonth' => $selectedMonth2, 'selectedYear' => $selectedYear2, 'tipo' => 'producto', 'operacion' => $selectedOperacion2]) }}" class="btn btn-danger" target="_blank">Generar Pdf</a>
                </div>
            </div>
            @endcan
        </div>
    </div>
</div>