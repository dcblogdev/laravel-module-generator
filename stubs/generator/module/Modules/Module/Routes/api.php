<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/{module}', function (Request $request) {
    return $request->user();
});