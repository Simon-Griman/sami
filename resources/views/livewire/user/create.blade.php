<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="card mt-2 col col-lg-9 mx-auto">
            <div class="card-body pb-0 w-100">            
                <form wire:submit.prevent="crear">
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="name">Nombre del Usuario</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" wire:model="name">
                            @error('name') <span class="text-red">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="email">E-mail del Usuario</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" wire:model="email">
                            @error('email') <span class="text-red">{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="form-group col-12">
                            <label for="cedula">Cedula del Usuario</label>
                            <input type="number" class="form-control @error('cedula') is-invalid @enderror" id="cedula" wire:model="cedula">
                            @error('cedula') <span class="text-red">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="cedula">Ubicación del Usuario</label>
                            <select class="form-control @error('ubicacion') is-invalid @enderror" wire:model="ubicacion">
                                <option value="">-- Seleccionar --</option>                            
                                @foreach ($ubicaciones as $ubicacion)
                                    <option value="{{ $ubicacion->id }}">{{ $ubicacion->nombre }}</option>
                                @endforeach
                            </select>
                            @error('ubicacion') <span class="text-red">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="role">Lista de Roles</label>
                            {{--<select name="role" id="" class="form-control @error('cedula') is-invalid @enderror" wire:model="role">
                                <option value="">--Seleccionar--</option>
                                @foreach ($roles as $id => $name)
                                <option value="{{ $name }}">{{ $name }}</option>
                                @endforeach
                            </select>--}}

                            @foreach ($roles as $role)
                            @if ($role->name != 'Super-Admin')
                            <div class="form-check">
                                <input wire:model.livewire="selectedRoles" class="form-check-input" type="checkbox" id="{{ $role->id }}" value="{{ $role->name }}">
                                <label for="{{ $role->id }}" class="form-check-label">{{ $role->name }}</label>
                            </div>
                            @endif
                            @endforeach

                            @error('role') <span class="text-red">{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="text-center col-12">
                            <button class="btn btn-primary m-4" type="submit">Crear</button>
                            <a href="{{ route('users.index') }}" class="btn btn-danger">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>