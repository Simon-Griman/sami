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
                <div class="modal-dialog @if($name_table == 'consolidado' || $name_table == 'cintillo') modal-xl @elseif($name_table == 'ubicacion' || $name_table == 'role') modal-sm @endif">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                            <h5 class="modal-title" id="exampleModalLabel">Registro creado por <b>{{ $name }}</b></h5>
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
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($consolidado)
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
                                    </tr>
                                    @else
                                    <tr>
                                        <td colspan="9" class="text-red">El registro fue borrado, puede consultar la información de eliminación en el area de registros eliminados</td>
                                    </tr>
                                    @endif
                                </tbody>
                                @elseif($name_table == 'ubicacion')
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($ubicacion)
                                    <tr>
                                        <td>{{ $ubicacion->nombre }}</td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td class="text-red">El registro fue borrado, puede consultar la información de eliminación en el area de registros eliminados</td>
                                    </tr>
                                    @endif
                                </tbody>
                                @elseif($name_table == 'segregacion')
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Hidrocarburo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($segregacion)
                                    <tr>
                                        <td>{{ $segregacion->nombre }}</td>
                                        <td>{{ $segregacion->hidrocarburo }}</td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td colspan="2" class="text-red">El registro fue borrado, puede consultar la información de eliminación en el area de registros eliminados</td>
                                    </tr>
                                    @endif
                                </tbody>
                                @elseif($name_table == 'usuario')
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>Cedula</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->cedula }}</td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td colspan="3" class="text-red">El registro fue borrado, puede consultar la información de eliminación en el area de registros eliminados</td>
                                    </tr>
                                    @endif
                                </tbody>
                                @elseif($name_table == 'cintillo')
                                <tbody>
                                    @if ($cintillo)
                                    <tr>
                                        <td><img src="{{ url('storage/' . $cintillo->nombre) }}" alt="" class="cintillo" style="width:100%"></td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td class="text-red">El registro fue borrado, puede consultar la información de eliminación en el area de registros eliminados</td>
                                    </tr>
                                    @endif
                                </tbody>
                                @elseif($name_table == 'role')
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @if ($role)
                                        <td>{{ $role->name }}</td>
                                        @else
                                        <td class="text-red">El registro fue borrado, puede consultar la información de eliminación en el area de registros eliminados</td>
                                        @endif
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