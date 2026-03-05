<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class MigrateFreshWithCleanup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:fresh-clean {--seed : Indica si los seeders deben ser ejecutados después de la migración.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Borra las imágenes del storage y ejecuta migrate:fresh';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $borrar = false;

        $this->info('Limpiando la carpeta de imágenes del storage...');

        $imagesToDelete = Storage::disk('public')->allFiles('images');

        $filesToDelete = Storage::disk('public')->allFiles('certificados');

        if (!empty($imagesToDelete))
        {
            Storage::disk('public')->delete($imagesToDelete);

            $this->info(count($imagesToDelete) . ' archivos eliminados de la carpeta images');

            $borrar = true;
        }

        if (!empty($filesToDelete))
        {
            Storage::disk('public')->delete($filesToDelete);

            $this->info(count($filesToDelete) . ' archivos eliminados de la carpeta certificados');

            $borrar = true;
        }

        if (!$borrar)
        {
            $this->warn('No se encontraron archivos para eliminar en la carpeta images');
        }

        $this->info('Ejecutando php artisan migrate:fresh...');

        $this->call('migrate:fresh', ['--seed' => $this->option('seed')]);

        $this->info('Base de datos refrescada y archivos limpiados.');

        return Command::SUCCESS;
    }
}