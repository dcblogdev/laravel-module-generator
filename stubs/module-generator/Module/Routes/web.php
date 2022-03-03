<?php

use Modules\{Module}\Http\Controllers\{Module}Controller;

Route::middleware('auth')->prefix('app/{module}')->group(function() {
    Route::get('/', [{Module}Controller::class, 'index'])->name('app.{module}.index');
    Route::get('create', [{Module}Controller::class, 'create'])->name('app.{module}.create');
    Route::post('create', [{Module}Controller::class, 'store'])->name('app.{module}.store');
    Route::get('edit/{id}', [{Module}Controller::class, 'edit'])->name('app.{module}.edit');
    Route::patch('edit/{id}', [{Module}Controller::class, 'update'])->name('app.{module}.update');
    Route::delete('delete/{id}', [{Module}Controller::class, 'destroy'])->name('app.{module}.delete');
});
