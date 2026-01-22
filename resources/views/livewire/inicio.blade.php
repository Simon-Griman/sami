<div class="container mt-2">
    <div class="row">

        <header class="card col-md-12 p-2">
            <h5 class="fw-bold text-center">Total de Consolidados Creados</h5>
            <h4 class="text-center text-primary"><strong>{{ $total_consolidado }}</strong></h4>
        </header>
        
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm " style="border-radius: 15px; max-height: 400px;">
                <div class="card-head">
                    <h5 class="text-center mt-4">Consolidados Por Ubicación</h5>
                </div>
                <div class="card-body d-flex flex-column overflow-auto">
                    <label for="fecha-inicio">Fecha Inicial</label>
                    <input type="date" class="form-control" id="fecha-inicio" wire:model="fecha_inicio" wire:change="refreshData"><br>
                    <label for="fecha-inicio">Fecha Final</label>
                    <input type="date" class="form-control" id="fecha-final" wire:model="fecha_final" wire:change="refreshData">
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm " style="border-radius: 15px; max-height: 400px;">
                <div class="card-head">
                    <h5 class="text-center mt-4">Consolidados Por Usuario</h5>
                </div>
                <div class="card-body d-flex flex-column overflow-auto">
                    <label for="fecha-inicio">Fecha Inicial</label>
                    <input type="date" class="form-control" id="fecha-inicio" wire:model="fecha_inicio" wire:change="refreshDataUser"><br>
                    <label for="fecha-inicio">Fecha Final</label>
                    <input type="date" class="form-control" id="fecha-final" wire:model="fecha_final" wire:change="refreshDataUser">
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm " style="border-radius: 15px; max-height: 400px;">
                <div class="card-body d-flex flex-column overflow-auto">
                    <h5 class="text-center mt-2">Usuario del Mes de {{ Illuminate\Support\Str::ucfirst($nombre_mes_anterior) }}</h5>
                    @if($user_mes)
                    <h4 class="text-center text-primary mt-4"><i class="fas fa-star"></i> <strong>{{ $user_mes->user }}</strong> <i class="fas fa-star"></i></h4>
                    <h5 class="text-center mt-2">Registros Creados</h5>
                    <h4 class="text-center text-primary mt-2">{{ $user_mes->cantidad }}</h4>
                    @endif
                </div>
            </div>
        </div>

        <div class="w-100 card" style="background-color: #fff; position: relative; min-height: 350px;">
            <div wire:loading.flex class="flex-column justify-content-center align-items-center" 
                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255,255,255,0.8); z-index: 10; border-radius: 5px;">
                
                <div class="spinner-border text-primary mb-2" role="status" style="width: 3rem; height: 3rem;"></div>
                
                <h5 class="text-primary fw-bold">Actualizando gráfico...</h5>
            </div>

            <div wire:loading.class="opacity-25" id="chart"></div>
        </div>
    </div>

    <script src="{{ url('js/apexcharts.js') }}"></script>
    <script>
        document.addEventListener('livewire:load', function () {
            const options = {
                chart: { type: 'bar', height: 350 },
                series: [{ name: 'Consolidao', data: @json($orderData['values']) }],
                xaxis: { categories: @json($orderData['labels']), labels: {
        rotate: -45,
        trim: true,
        style: { fontSize: '10px' }} },
                plotOptions: { bar: { borderRadius: 4, dataLabels: { position: 'top' } }}
            };

            const chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();

            // Escuchar cambios desde Livewire
            window.livewire.on('updateChart', data => {
                chart.updateSeries([{ data: data.values }]);
                chart.updateOptions({ xaxis: { categories: data.labels } });
            });
        });
    </script>
</div>