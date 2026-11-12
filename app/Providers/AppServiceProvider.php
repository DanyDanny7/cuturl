<?php

namespace App\Providers;

use App\Services\CodeGenerator\CodeGenerator;
use App\Services\CodeGenerator\RandomCodeGenerator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Punto de cambio #1: cuando alguien pida la interfaz CodeGenerator,
        // Laravel le entrega un RandomCodeGenerator. El día que queramos Sqids,
        // cambiamos SOLO esta línea por SqidsCodeGenerator::class y listo —
        // el controller y el resto del código ni se enteran.
        $this->app->bind(CodeGenerator::class, RandomCodeGenerator::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
