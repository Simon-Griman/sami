<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="card mt-2 col col-lg-9 mx-auto">
            <div class="card-body pb-0 w-100">            
                <form wire:submit.prevent="crear">
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="fecha">Fecha</label>
                            <input type="date" class="form-control @error('fecha') is-invalid @enderror" id="fecha" wire:model="fecha">
                            @error('fecha') <span class="text-red">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-12">
                            <label for="instalacion">Instalación</label>
                            <select name="" id="instalación" class="form-control @error('instalacion') is-invalid @enderror" wire:model="instalacion">
                                <option value="">-- Seleccionar --</option>                                
                                @foreach ($instalacions as $instalacion)
                                <option value="{{ $instalacion->id }}">{{ $instalacion->nombre }}</option>
                                @endforeach
                            </select>
                            @error('instalacion') <span class="text-red">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-12">
                            <label for="ubicacion">Ubicación</label>
                            <select name="" id="ubicacion" class="form-control @error('ubicacion') is-invalid @enderror" wire:model="ubicacion">
                                <option value="">-- Seleccionar --</option>                                
                                @foreach ($ubicacions as $ubicacion)
                                <option value="{{ $ubicacion->id }}">{{ $ubicacion->nombre }}</option>
                                @endforeach
                            </select>
                            @error('ubicacion') <span class="text-red">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-12">
                            <label for="cliente">Cliente</label>
                            <input type="text" class="form-control @error('cliente') is-invalid @enderror" id="cliente" wire:model="cliente">
                            @error('cliente') <span class="text-red">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-12">
                            <label for="producto">Hidrocarburo</label>
                            <select name="" id="producto" class="form-control @error('producto') is-invalid @enderror" wire:model="producto">
                                <option value="">-- Seleccionar --</option>                                
                                @foreach ($productos as $producto)
                                <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                                @endforeach
                            </select>
                            @error('producto') <span class="text-red">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-12">
                            <label for="segregacion">Segregación</label>
                            <select name="" id="segregacion" class="form-control @error('segregacion') is-invalid @enderror" wire:model="segregacion">
                                <option value="">-- Seleccionar --</option>                                
                                @foreach ($segregaciones as $segregacion)
                                <option value="{{ $segregacion->id }}">{{ $segregacion->nombre }}</option>
                                @endforeach
                            </select>
                            @error('segregacion') <span class="text-red">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-12">
                            <label for="destino">Destino</label>
                            <input type="text" class="form-control @error('destino') is-invalid @enderror" id="destino" wire:model="destino">
                            @error('destino') <span class="text-red">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-12">
                            <label for="volumen">Volumen Neto</label>
                            <input type="number" class="form-control @error('volumen') is-invalid @enderror" id="volumen" wire:model="volumen">
                            @error('volumen') <span class="text-red">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-12">
                            <label for="certificado">Cargar Certificado</label><br>
                            <input type="file" wire:model="certificado" id="certificado"><br>
                            @error('certificado') <span class="error text-red">{{ $message }}</span> @enderror
                        </div>

                        <div class="text-center col-12">
                            <button class="btn btn-primary m-4" type="submit">Crear</button>
                            <a href="{{ route('consolidado.index') }}" class="btn btn-danger">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


