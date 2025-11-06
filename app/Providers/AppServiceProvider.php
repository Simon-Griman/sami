<?php

namespace App\Providers;

use App\Models\Cintillo;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        $cintilloModel = Cintillo::where('activo', 2)->first();

        if ($cintilloModel)
        {
            $cintillo = $cintilloModel->nombre;
        }
        else
        {
            $cintillo = '';
        }
        
        View::share('cintillo', $cintillo);
    }
}
