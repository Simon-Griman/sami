<div class="">
    <div class="row d-flex justify-content-center">
        <div class="card mt-2" style="max-height: 70vh;">
            <div class="card-body overflow-auto">
                <table class="table table-responsive table-hover">
                    <thead>
                        <tr>
                            <th><input wire:model="fecha_inicio" type="date" class="form-control">
                                <input wire:model="fecha_final" type="date" class="form-control">
                                <br>Fecha</th>
                            <th>
                                <select class="form-control" wire:model="instalacion">
                                    <option value="">Todo</option>                            
                                    @foreach ($instalaciones as $instalacion)
                                        <option value="{{ $instalacion->nombre }}">{{ $instalacion->nombre }}</option>
                                    @endforeach
                                </select>
                                <br>Instalación
                            </th>
                            <th>
                                <select class="form-control" wire:model="ubicacion">
                                    <option value="">Todo</option>                            
                                    @foreach ($ubicaciones as $ubicacion)
                                        <option value="{{ $ubicacion->nombre }}">{{ $ubicacion->nombre }}</option>
                                    @endforeach
                                </select>
                                <br>Ubicación
                            </th>
                            <th><input wire:model="cliente" type="text" class="form-control"><br>Cliente</th>
                            <th>
                                <select class="form-control" wire:model="producto">
                                    <option value="">Todo</option>                            
                                    @foreach ($productos as $producto)
                                        <option value="{{ $producto->nombre }}">{{ $producto->nombre }}</option>
                                    @endforeach
                                </select>
                                <br>Hidrocarburo
                            </th>
                            <th>
                                <select class="form-control" wire:model="segregacion">
                                    <option value="">Todo</option>                            
                                    @foreach ($segregaciones as $segregacion)
                                        <option value="{{ $segregacion->nombre }}">{{ $segregacion->nombre }}</option>
                                    @endforeach
                                </select>
                                <br>Segregación
                            </th>
                            <th><input wire:model="destino" type="text" class="form-control"><br>Destino</th>
                            <th><input wire:model="volumen" type="number" class="form-control"><br>Volumen</th>
                            <th>
                                <select class="form-control" wire:model="operacion">
                                    <option value="">Todo</option>                            
                                    <option value="Recibo">Recibo</option>
                                    <option value="Venta">Venta</option>
                                    <option value="Despacho">Despacho</option>
                                </select>
                                <br>Operación
                            </th>
                            <th><br>Certificado</th>
                            @if (auth()->user()->can('consolidado.edit') || auth()->user()->can('consolidado.delete'))
                            <th colspan="2">Acciones</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($consolidados as $consolidado)
                        <tr>
                            <td>{{ $consolidado->fecha }}</td>
                            <td>{{ $consolidado->instalacion }}</td>
                            <td>{{ $consolidado->ubicacion }}</td>
                            <td>{{ $consolidado->cliente }}</td>
                            <td>{{ $consolidado->producto }}</td>
                            <td>{{ $consolidado->segregacion }}</td>
                            <td>{{ $consolidado->destino }}</td>
                            <td>{{ $consolidado->volumen }}</td>
                            <td>{{ $consolidado->operacion }}</td>

                            <td style="padding: 2px;">
                                <a href="{{ url('ver-pdf/' . basename($consolidado->certificado)) }}" target="_blank" class="btn btn-danger mx-2"><i class="fas fa-file-pdf"></i></a>
                            </td>
                            
                            @can('consolidado.edit')
                            <td style="padding: 2px;">
                                <a href="{{ route('consolidado.edit', $consolidado->id_consolidado) }}" class="btn btn-primary" title="editar"><i class="fas fa-pen"></i></a>
                            </td>
                            @endcan

                            @can('consolidado.delete')
                            <td style="padding: 2px;">
                                <button class="btn btn-danger" wire:click="confirBorrar({{ $consolidado->id_consolidado }})" data-toggle="modal" data-target="#borrar" title="borrar"><i class="fas fa-trash"></i></button>
                            </td>
                            @endcan
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <div class="modal fade" id="borrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-danger">
                                <h5 class="modal-title" id="exampleModalLabel">Eliminar</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <h5>
                                    ¿Realmente desea borrar el producto: <b>{{ $c_borrar }}</b>?
                                   
                                </h5>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-danger" wire:click.defer="borrar()">Eliminar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-center">
                {{ $consolidados->links() }}
            </div>
        </div>
    </div>

    <script src="{{ url('js/jquery.js') }}"></script>
    
    <script src="{{ url('js/toastr.js') }}"></script>    
    <script>
        $(document).ready(function() {

            toastr.options = {
                "positionClass": "toast-bottom-right",
                "progressBar": true,
                "closeButton": true,
            }

            window.addEventListener('borrar', event => {

                $('#borrar').modal('hide');
                toastr.success("El registro ha sido eliminado", "¡Hecho!");
            });

            window.addEventListener('crear', event => {

                $('#dependiente').modal('hide');
                toastr.success("El periferico ha sido añadido con exito", "¡Hecho!");
            });
            
        });

        document.addEventListener('livewire:load', function(){
            $('.select2').select2();

            $('#sel1').on('change', function(){
                @this.set('tipo', this.value);
            });

            $('#sel2').on('change', function(){
                @this.set('marca', this.value);
            });

            $('#sel4').on('change', function(){
                @this.set('departamento', this.value);
            });

            $('#sel5').on('change', function(){
                @this.set('usuario', this.value);
            });

            $('#sel6').on('change', function(){
                @this.set('ubicacion', this.value);
            });
        });
    </script>
</div>
