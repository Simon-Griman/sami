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
                                <input wire:model="id_tabla" type="number" class="form-control" placeholder="Buscar:">
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
                                    wire:click="verConsolidado('{{ $registro->name }}', '{{ $registro->batch_id}}')" 
                                    
                                    @elseif($registro->model_name == 'Ubicacion')
                                    wire:click="verUbicacion('{{ $registro->name }}', '{{ $registro->batch_id}}')"

                                    @elseif($registro->model_name == 'Segregacion')
                                    wire:click="verSegregacion('{{ $registro->name }}', '{{ $registro->batch_id}}')"

                                    @elseif($registro->model_name == 'User')
                                    wire:click="verUser('{{ $registro->name }}', '{{ $registro->batch_id}}')"

                                    @elseif($registro->model_name == 'Cintillo')
                                    wire:click="verCintillo('{{ $registro->name }}', '{{ $registro->batch_id}}')"

                                    @elseif($registro->model_name == 'Role')
                                    wire:click="verRole('{{ $registro->name }}', '{{ $registro->batch_id}}')"

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
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                            <h5 class="modal-title" id="exampleModalLabel">Registro editado por <b>{{ $name }}</b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-responsive table-hover text-center center">
                                @if($name_table == 'consolidado')
                                <thead class="text-center center">
                                    <tr class="w-100">
                                        <th>Campo</th>
                                        <th class="bg-red">Valor Antes</th>
                                        <th class="bg-green">Valor despues</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($modelos as $modelo)
                                    <tr>
                                        <td>{{ $modelo->campo }}</td>
                                        <td class="bg-red">{{ $modelo->valor_antes }}</td>
                                        <td class="bg-green">{{ $modelo->valor_despues }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                @elseif($name_table == 'ubicacion')
                                <thead>
                                    <tr>
                                        <th>Campo</th>
                                        <th class="bg-red">Valor Antes</th>
                                        <th class="bg-green">Valor despues</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $modelos->campo }}</td>
                                        <td class="bg-red">{{ $modelos->valor_antes }}</td>
                                        <td class="bg-green">{{ $modelos->valor_despues }}</td>
                                    </tr>
                                </tbody>
                                @elseif($name_table == 'segregacion')
                                <thead>
                                    <tr>
                                        <th>Campo</th>
                                        <th class="bg-red">Valor Antes</th>
                                        <th class="bg-green">Valor despues</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($modelos as $modelo)
                                    <tr>
                                        <td>{{ $modelo->campo }}</td>
                                        <td class="bg-red">{{ $modelo->valor_antes }}</td>
                                        <td class="bg-green">{{ $modelo->valor_despues }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                @elseif($name_table == 'usuario')
                                <thead>
                                    <tr>
                                        <th>Campo</th>
                                        <th class="bg-red">Valor Antes</th>
                                        <th class="bg-green">Valor despues</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($modelos as $modelo)
                                    <tr>
                                        <td>{{ $modelo->campo }}</td>
                                        <td class="bg-red">{{ $modelo->valor_antes }}</td>
                                        <td class="bg-green">{{ $modelo->valor_despues }}</td>
                                    </tr>
                                    @endforeach
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