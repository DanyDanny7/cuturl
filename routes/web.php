<?php

use App\Http\Controllers\LinkController;
use Illuminate\Support\Facades\Route;

// Formulario para crear un link.
Route::get('/', [LinkController::class, 'create'])->name('links.create');

// Crear el link (recibe el POST del formulario).
Route::post('/links', [LinkController::class, 'store'])->name('links.store');

// Resolver un código y redirigir al destino.
//
// IMPORTANTE: esta ruta comodín {code} atrapa CUALQUIER path de un segmento,
// así que va AL FINAL. Si estuviera antes, se "comería" rutas como /links.
// La restricción where evita que capture rutas con puntos o barras.
Route::get('/{code}', [LinkController::class, 'resolve'])
    ->where('code', '[A-Za-z0-9]+')
    ->name('links.resolve');
