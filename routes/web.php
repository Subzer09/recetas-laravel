<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/recetas', [\App\Http\Controllers\RecetaController::class, 'index'])->name('recetas.index');
Route::get('/recetas/create', [\App\Http\Controllers\RecetaController::class, 'create'])->name('recetas.create');
Route::post('/recetas', [\App\Http\Controllers\RecetaController::class, 'store'])->name('recetas.store');
Route::get('/recetas/{receta}', [\App\Http\Controllers\RecetaController::class, 'show'])->name('recetas.show');
Route::get('recetas/{receta}/edit', [\App\Http\Controllers\RecetaController::class, 'edit'])->name('recetas.edit');
Route::put('/recetas/{receta}', [\App\Http\Controllers\RecetaController::class, 'update'])->name('recetas.update');
Route::delete('/recetas/{receta}', [\App\Http\Controllers\RecetaController::class, 'destroy'])->name('recetas.destroy');


Route::get('/perfiles/{perfil}', [\App\Http\Controllers\PerfilController::class, 'show'])->name('perfiles.show');
Route::get('/perfiles/{perfil}/edit', [\App\Http\Controllers\PerfilController::class, 'edit'])->name('perfiles.edit');
Route::put('/perfiles/{perfil}', [\App\Http\Controllers\PerfilController::class, 'update'])->name('perfiles.update');

Auth::routes();

