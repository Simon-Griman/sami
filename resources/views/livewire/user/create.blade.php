<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="card mt-2 col col-lg-9 mx-auto">
            <div class="card-body pb-0 w-100">            
                <form wire:submit.prevent="crear">
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="name">Nombre del Usuario</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" wire:model="name">
                            @error('name') <span class="text-danger d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="email">E-mail del Usuario</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" wire:model="email">
                            @error('email') <span class="text-danger d-block">{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="form-group col-12">
                            <label for="cedula">Cédula del Usuario</label>
                            <input type="number" class="form-control @error('cedula') is-invalid @enderror" id="cedula" wire:model="cedula">
                            @error('cedula') <span class="text-danger d-block">{{ $message }}</span> @enderror
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

                        {{-- Ubicaciones (Checkboxes N:M) --}}
                        <div class="form-group col-12">
                            <label>Terminales con Acceso</label>

                            @foreach ($ubicaciones as $ub)
                            <div class="form-check">
                                <input wire:model="selectedUbicaciones" class="form-check-input" type="checkbox" id="ubicacion-{{ $ub->id }}" value="{{ $ub->id }}">
                                <label for="ubicacion-{{ $ub->id }}" class="form-check-label">{{ $ub->nombre }}</label>
                            </div>
                            @endforeach
                            
                            @error('selectedUbicaciones') <span class="text-danger d-block">{{ $message }}</span> @enderror
                        </div>

                        {{-- Roles --}}
                        <div class="form-group col-12">
                            <label>Lista de Roles</label>

                            @foreach ($roles as $role)
                            <div class="form-check">
                                <input wire:model="selectedRoles" class="form-check-input" type="checkbox" id="role-{{ $role->id }}" value="{{ $role->name }}">
                                <label for="role-{{ $role->id }}" class="form-check-label">{{ $role->name }}</label>
                            </div>
                            @endforeach

                            @error('selectedRoles') <span class="text-danger d-block">{{ $message }}</span> @enderror
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