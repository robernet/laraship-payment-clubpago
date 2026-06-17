<?php

namespace Corals\Modules\Payment\ClubPago\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class ClubPagoRouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        parent::boot();
    }

    public function map(): void
    {
        $this->mapApiRoutes();
        $this->mapWebRoutes();
    }

    protected function mapWebRoutes(): void
    {
        Route::middleware('web')
            ->group(__DIR__ . '/../routes/web.php');
    }

    protected function mapApiRoutes(): void
    {
        Route::prefix('api/' . config('corals.api_version'))
            ->middleware('api')
            ->group(__DIR__ . '/../routes/api.php');
    }
}
