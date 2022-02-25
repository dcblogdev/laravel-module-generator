<?php

use App\Http\Controllers\Api\V1\{Module}Controller;

Route::middleware(['auth:sanctum'])->prefix('{module}')->group(function () {
    Route::get('/', [{Module}Controller::class, 'index'])->name('{module}');
    Route::get('{{model}:uuid}', [{Module}Controller::class, 'show'])->name('{module}.show');
    Route::post('/', [{Module}Controller::class, 'store'])->name('{module}.store');
    Route::put('{{model}:uuid}', [{Module}Controller::class, 'update'])->name('{module}.update');
    Route::delete('{{model}:uuid}', [{Module}Controller::class, 'destroy'])->name('{module}.delete');
});