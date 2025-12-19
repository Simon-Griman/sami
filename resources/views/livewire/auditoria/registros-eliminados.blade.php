<div class="">
    <div class="row d-flex justify-content-center">
        <div class="card mt-2 pt-0" style="max-height: 70vh;">
            <div class="card-body overflow-auto">
                <table class="table table-responsive table-hover">
                    <thead>
                        <tr>
                            <th>
                                <input wire:model="usuario" type="text" class="form-control" placeholder="Buscar:">
                                <br>Usuario
                            </th>
                            <th>
                                <input wire:model="tabla" type="text" class="form-control" placeholder="Buscar:">
                                <br>Tabla
                            </th>
                            <th>
                                <input wire:model="id_consolidado" type="number" class="form-control" placeholder="Buscar:">
                                <br>ID
                            </th>
                            <th>Registro</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($registros as $registro)
                        <tr>
                            <td>{{ $registro->name }}</td>
                            <td>{{ $registro->model_name }}</td>
                            <td>{{ $registro->model_id }}</td>
                            <td>
                                <button class="btn btn-danger" 
                                    @if($registro->model_name == 'Consolidado') 
                                    wire:click="verConsolidado('{{ $registro->name }}', {{ $registro->model_id }})" 
                                    
                                    @elseif($registro->model_name == 'Ubicacion')
                                    wire:click="verUbicacion('{{ $registro->name }}', {{ $registro->model_id }})"

                                    @elseif($registro->model_name == 'Segregacion')
                                    wire:click="verSegregacion('{{ $registro->name }}', {{ $registro->model_id }})"

                                    @elseif($registro->model_name == 'User')
                                    wire:click="verUser('{{ $registro->name }}', {{ $registro->model_id }})"

                                    @elseif($registro->model_name == 'Cintillo')
                                    wire:click="verCintillo('{{ $registro->name }}', {{ $registro->model_id }})"

                                    @elseif($registro->model_name == 'Role')
                                    wire:click="verRole('{{ $registro->name }}', {{ $registro->model_id }})"

                                    @endif data-toggle="modal" data-target="#registro">
                                    <i class="fas fa-eye"></i> Ver
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer d-flex justify-content-center">
                {{ $registros->links() }}
            </div>

            <div class="modal fade" id="registro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
                <div class="modal-dialog @if($name_table == 'consolidado') modal-xl @elseif($name_table == 'ubicacion' || $name_table == 'role' || $name_table == 'segregacion') modal-sm @endif">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                            <h5 class="modal-title" id="exampleModalLabel">Registro borrado por <b>{{ $name }}</b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-responsive table-hover text-center center">
                                @if($name_table == 'consolidado')
                                <thead class="text-center center">
                                    <tr class="w-100">
                                        <th>Fecha</th>
                                        <th>Instalación</th>
                                        <th>ubicación</th>
                                        <th>Cliente</th>
                                        <th>Hidrocarburo</th>
                                        <th>Segregación</th>
                                        <th>Destino</th>
                                        <th>Volumen</th>
                                        <th>Operación</th>
                                        <th>Eliminado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $modelo->fecha }}</td>
                                        <td>{{ $modelo->instalacion }}</td>
                                        <td>{{ $modelo->ubicacion }}</td>
                                        <td>{{ $modelo->cliente }}</td>
                                        <td>{{ $modelo->producto }}</td>
                                        <td>{{ $modelo->segregacion }}</td>
                                        <td>{{ $modelo->destino }}</td>
                                        <td>{{ $modelo->volumen }}</td>
                                        <td>{{ $modelo->operacion }}</td>
                                        <td>{{ $modelo->deleted_at }}</td>
                                    </tr>
                                </tbody>
                                @elseif($name_table == 'ubicacion')
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $modelo->ubicacion }}</td>
                                    </tr>
                                </tbody>
                                @elseif($name_table == 'segregacion')
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $modelo->segregacion }}</td>
                                    </tr>
                                </tbody>
                                @elseif($name_table == 'usuario')
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Cedula</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $modelo->user }}</td>
                                        <td>{{ $modelo->cedula }}</td>
                                    </tr>
                                </tbody>
                                @elseif($name_table == 'cintillo')
                                <tbody>
                                    <tr>
                                        <td>{{ $modelo->cintillo }}</td>
                                    </tr>
                                </tbody>
                                @elseif($name_table == 'role')
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $modelo->role }}</td>
                                    </tr>
                                </tbody>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>