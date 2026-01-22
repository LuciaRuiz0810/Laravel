<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TareasController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect('/index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/', [HomeController::class, 'getHome']);
    Route::get('/index', [TareasController::class, 'getIndex']);   

    Route::get('/tareas/create', [TareasController::class, 'createTareaForm']);
    Route::post('/tareas/create/new', [TareasController::class, 'createTarea']);

    Route::get('/tareas/edit/{id}', [TareasController::class, 'editTareaForm']);
    Route::put('/tareas/edit/{id}/new', [TareasController::class, 'editTarea']);

    Route::delete('/tareas/delete/{id}', [TareasController::class, 'deleteTarea']);

    Route::get('/tareas/show/{id}', [TareasController::class, 'showTarea']);
});

require __DIR__ . '/auth.php';
