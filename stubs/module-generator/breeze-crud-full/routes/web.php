<?php

use Illuminate\Support\Facades\Route;
use Modules\{Module}\Http\Controllers\{Module}Controller;

Route::middleware('auth')->group(function() {
    Route::resource('{module}', {Module}Controller::class)->names('{module}');
});
