<?php

namespace Modules\{Module}\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public function map(): void
    {
        Route::prefix('api/v1')
            ->middleware('api')
            ->group(module_path('{module}', '/routes/api/v1.php'));
    }
}
