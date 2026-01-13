<div>
    @can('users.delete')

    <form wire:submit.prevent="ubicacion">
            <h5>Ubicación</h5>
            <select class="form-control @error('ubicacion') is-invalid @enderror" wire:model="ubicacion">
                <option value="">-- Seleccionar --</option>                            
                @foreach ($ubicaciones as $ubicacion)
                    <option value="{{ $ubicacion->id }}">{{ $ubicacion->nombre }}</option>
                @endforeach
            </select>
            @error('ubicacion') <span class="text-red">{{ $message }}</span><br> @enderror
            <button class="btn btn-primary mt-2" type="submit">Actualizar Ubicación</button>
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