<div class="">
    <div class="row d-flex justify-content-center">
        <div class="card mt-2" style="max-height: 70vh;">
            <div class="card-head"><input wire:model="usuario" type="text" class="form-control" placeholder="Buscar Usuario:"></div>
            <div class="card-body overflow-auto">
                <table class="table table-responsive table-hover">
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Ultima Sesión</th>
                            <th>Mas Información</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sesiones as $sesion)
                        <tr>
                            <td>{{ $sesion->name }}</td>
                            <td>{{ Carbon\Carbon::create($sesion->last_login)->diffForHumans() }}</td>
                            <td class="text-center">
                                <button class="btn btn-danger" wire:click="registros({{ $sesion->id_user }})" data-toggle="modal" data-target="#borrar"><i class="fas fa-eye"></i> Ver</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer d-flex justify-content-center">
                {{ $sesiones->links() }}
            </div>

            <div class="modal fade" id="borrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                            <h5 class="modal-title" id="exampleModalLabel">Inicios de Sesión de <b>{{ $name }}</b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-responsive table-hover">
                                <thead>
                                    <tr>
                                        <th>Dirección IP</th>
                                        <th>Sistema</th>
                                        <th>Navegador</th>
                                        <th>Hora de Ingreso</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($log_usuario as $log)
                                    <tr>
                                        <td>{{ $log->ip_address }}</td>
                                        <td>{{ $log->sistema }}</td>
                                        <td>{{ $log->navegador }}</td>
                                        <td>{{ $log->login_at }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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
