<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

//Agregamos esta libreria la cual nos va a permitir pagina nuestras listas
use Illuminate\Pagination\Paginator;

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
        //Usmos el metodo Paginator para poder paginar pero antes debemos
        //agregar la libreria en este mismo archivo

        //useBootstrap()= esto indica que vamos a usar la paginacion de Bootsatrap
        Paginator::useBootstrap();
    }
}
