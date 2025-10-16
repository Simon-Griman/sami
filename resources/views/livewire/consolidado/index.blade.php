<div class="">
    <div class="row d-flex justify-content-center">
        <div class="card mt-2" style="max-height: 70vh;">
            <div class="card-body overflow-auto">
                <table class="table table-responsive table-hover">
                    <thead>
                        <tr>
                            <th><input wire:model="fecha" type="date" class="form-control"><br>Fecha</th>
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
                                <br>Producto
                            </th>
                            <th><input wire:model="segregacion" type="text" class="form-control"><br>Segregación</th>
                            <th><input wire:model="destino" type="text" class="form-control"><br>Destino</th>
                            <th colspan="2">Acciones</th>
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
                            
                            
                            <td style="padding: 2px;">
                                <a href="{{ route('consolidado.edit', $consolidado->id_consolidado) }}" class="btn btn-primary" title="editar"><i class="fas fa-pen"></i></a>
                            </td>
                            
                            <td style="padding: 2px;">
                                <button class="btn btn-danger" wire:click="confirBorrar({{ $consolidado->id_consolidado }})" data-toggle="modal" data-target="#borrar" title="borrar"><i class="fas fa-trash"></i></button>
                            </td>
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

                {{--<div class="modal fade" id="dependiente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-info">
                            <h5 class="modal-title" id="exampleModalLabel">Añadir Periferico</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="nombre" class="col-form-label">Nombre:</label>
                                    
                                    <select name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" wire:model.defer="nombre">
                                        <option value="">-- Seleccionar --</option>
                                        <option value="Teclado">Teclado</option>
                                        <option value="Mouse">Mouse</option>
                                        <option value="Cornetas">Cornetas</option>
                                    </select>

                                    @error('nombre')
                                    <span class="invalid-feedback">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="marca_id" class="col-form-label">Marca:</label>

                                    <select class="form-control select2 @error('marca_id') is-invalid @enderror" id="marca_id" wire:model.defer="marca_id">
                                        <option value="">-- Seleccionar --</option>                            
                                        @foreach ($marcas as $marca)
                                            <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
                                        @endforeach
                                    </select>

                                    @error('marca_id')
                                    <span class="invalid-feedback">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="modelo" class="col-form-label">Modelo:</label>

                                    <select class="form-control select2 @error('modelo_id') is-invalid @enderror" id="modelo" wire:model.defer="modelo_id">
                                        <option value="">-- Seleccionar --</option>                            
                                        @foreach ($modelos as $modelo)
                                            @if($modelo->nombre != 'S/M')
                                            <option value="{{ $modelo->id }}">{{ $modelo->nombre }}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                    @error('modelo_id')
                                    <span class="invalid-feedback">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="serial">Serial: </label>

                                    <input type="text" class="form-control @error('serial_dependiente') is-invalid @enderror" id="serial" wire:model.defer="serial_dependiente">

                                    @error('serial_dependiente')
                                    <span class="invalid-feedback">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-success" wire:click.prevent="crear()">Añadir</button>
                            </div>
                        </form>
                    </div>
                </div>--}}
            </div>

            </div>
            <div class="card-footer">
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
