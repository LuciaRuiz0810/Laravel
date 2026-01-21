<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\HomeController;

//Cuando se verifique el login, se mostrará la vista catalog
Route::get('/dashboard', function () {
    return view('catalog');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/', [HomeController::class, 'getHome']);

    Route::redirect('/dashboard', 'catalog');
    Route::redirect('/', 'catalog'); //Redirige al catálogo

    Route::get('catalog', [CatalogController::class, 'getIndex']);

    Route::get('catalog/show/{id}', [CatalogController::class, 'getShow']);

    Route::get('catalog/edit/{id}', [CatalogController::class, 'getEdit']);

    Route::put('catalog/edit/{id}/update', [CatalogController::class, 'putEdit']);

    Route::get('catalog/create', [CatalogController::class, 'getCreate']); //Ruta para mostrar el formulario

    Route::post('catalog/create/new', [CatalogController::class, 'postCreate']); //Ruta para procesar los datos del formulario


});



require __DIR__ . '/auth.php';
