<?php

use Illuminate\Support\Facades\Route;

Route::get('/search', [\App\Http\Controllers\CustomersController::class, 'index']);

//route resource
Route::resource('/customers', \App\Http\Controllers\CustomersController::class);