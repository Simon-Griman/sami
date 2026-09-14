<div>
    @can('users.delete')

    <form wire:submit.prevent="ubicacion">
        <h5>Terminales con Acceso</h5>

        <div class="form-group mb-3">
            @foreach ($ubicaciones as $ub)
                <div class="form-check">
                    <input 
                        wire:model="selectedUbicaciones" 
                        class="form-check-input" 
                        type="checkbox" 
                        id="ubicacion-{{ $ub->id }}" 
                        value="{{ $ub->id }}"
                    >
                    <label for="ubicacion-{{ $ub->id }}" class="form-check-label">
                        {{ $ub->nombre }}
                    </label>
                </div>
            @endforeach

            @error('selectedUbicaciones') 
                <span class="text-danger d-block mt-1">{{ $message }}</span>
            @enderror
        </div>

        <button class="btn btn-primary mt-2" type="submit">Actualizar Ubicaciones</button>
    </form>

    <hr>

    <form wire:submit.prevent="pass" class="mb-0 pl-0">
        <div class="mt-4 mb-4">
            <button class="btn btn-primary" type="submit">Actualizar Contraseña</button>
        </div>
    </form>

    <hr>
    @endcan
</div>