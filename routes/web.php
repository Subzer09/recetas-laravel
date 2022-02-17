<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/recetas', [\App\Http\Controllers\RecetaController::class, 'index'])->name('recetas.index');
Route::get('/recetas/create', [\App\Http\Controllers\RecetaController::class, 'create'])->name('recetas.create');
Route::post('/recetas', [\App\Http\Controllers\RecetaController::class, 'store'])->name('recetas.store');

Auth::routes();

