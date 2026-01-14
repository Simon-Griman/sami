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
                        @if ($mi_ubicacion == $sede)
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
                        @else
                        <div class="form-group col-12">
                            <label for="ubicacion">Ubicación</label>
                            <input type="text" disabled value="{{ $ubicacion_actual->nombre }}" class="form-control">
                            
                        </div>
                        @endif
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
                            <label for="operacion">Operación</label>
                            <select name="" id="operacion" class="form-control @error('operacion') is-invalid @enderror" wire:model="operacion">
                                <option value="">-- Seleccionar --</option>                                
                                <option value="Recibo">Recibo</option>
                                <option value="Venta">Venta</option>
                                <option value="Despacho">Despacho</option>
                            </select>
                            @error('operacion') <span class="text-red">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-12">
                            <label for="certificado">Cargar Certificado</label><br>
                            <div class="w-100">
                                <div
                                    x-data="{ isUploading: false, progress: 0, isDropping: false }"
                                    x-on:livewire-upload-start="isUploading = true"
                                    x-on:livewire-upload-finish="isUploading = false"
                                    x-on:livewire-upload-error="isUploading = false"
                                    x-on:livewire-upload-progress="progress = $event.detail.progress"
                                    class="position-relative"
                                >
                                    <div 
                                        class="card border-2 text-center p-4 transition-all"
                                        :class="isDropping ? 'border-primary bg-light' : 'border-secondary'"
                                        style="border-style: dashed !important; min-height: 180px;"
                                    >
                                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                                            
                                            <input 
                                                type="file" 
                                                class="input-hidden-custom"
                                                wire:model="certificado"
                                                x-on:dragover="isDropping = true"
                                                x-on:dragleave="isDropping = false"
                                                x-on:drop="isDropping = false"
                                            >

                                            <div class="py-2">
                                                <div>
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" width="100" height="100"><path fill="#007BFF" d="M176 544C96.5 544 32 479.5 32 400C32 336.6 73 282.8 129.9 263.5C128.6 255.8 128 248 128 240C128 160.5 192.5 96 272 96C327.4 96 375.5 127.3 399.6 173.1C413.8 164.8 430.4 160 448 160C501 160 544 203 544 256C544 271.7 540.2 286.6 533.5 299.7C577.5 320 608 364.4 608 416C608 486.7 550.7 544 480 544L176 544zM337 255C327.6 245.6 312.4 245.6 303.1 255L231.1 327C221.7 336.4 221.7 351.6 231.1 360.9C240.5 370.2 255.7 370.3 265 360.9L296 329.9L296 432C296 445.3 306.7 456 320 456C333.3 456 344 445.3 344 432L344 329.9L375 360.9C384.4 370.3 399.6 370.3 408.9 360.9C418.2 351.5 418.3 336.3 408.9 327L336.9 255z"/></svg>
                                                </div>
                                                <h6 class="fw-bold mb-1">Arrastra tu certificado aquí</h6>
                                                <p class="text-muted small mb-2">o haz clic para buscar en tu equipo</p>
                                                <span class="badge rounded-pill bg-light text-dark border fw-normal">
                                                    PDF (Máx. 2MB)
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div wire:loading wire:target="certificado" class="text-primary small mt-1">
                                        <div class="spinner-border spinner-border-sm" role="status"></div>
                                        Subiendo archivo...
                                    </div>

                                    @if ($certificado)
                                        <div class="alert alert-success mt-2 d-flex align-items-center justify-content-between py-2">
                                            <span>
                                                <i class="bi bi-file-earmark-check-fill me-2"></i>
                                                {{ $certificado->getClientOriginalName() }}
                                            </span>
                                            <button type="button" class="btn btn-sm btn-danger" wire:click="$set('certificado', null)">
                                                Quitar
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @error('certificado') <span class="error text-red">{{ $message }}</span> @enderror

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


