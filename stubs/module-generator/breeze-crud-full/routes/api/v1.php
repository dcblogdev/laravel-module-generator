<?php

use Illuminate\Support\Facades\Route;
use Modules\{Module}\App\Http\Controllers\Api\V1\{Module}Controller;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::ApiResource('{module}', {Module}Controller::class, ['as' => 'api.v1']);
});