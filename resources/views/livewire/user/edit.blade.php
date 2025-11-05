<div>
    @can('users.delete')
    <form wire:submit.prevent="editar" class="mb-0 pl-0">
        <div class="mt-4 mb-4">
            <button class="btn btn-primary" type="submit">Actualizar Contraseña</button>
        </div>
    </form>
    <hr>
    @endcan
</div>