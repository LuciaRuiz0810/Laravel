<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TareasController;
use App\Http\Middleware\admin;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;

Route::middleware('auth')->group(function () {
    $user = Auth::user();
    if ($user && $user->name === 'admin') {
        return redirect('/index');
    }
    return view('user.index');
})->middleware('auth');




Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/user/index', [TareasController::class, 'getIndexUser']);
    Route::get('/user/show/{id}', [TareasController::class, 'showTareaUser']);

    Route::middleware('admin')->group(function () {

        Route::get('/', [HomeController::class, 'getHome']);

        Route::get('/index', [TareasController::class, 'getIndex']);
        Route::get('/tareas/create', [TareasController::class, 'createTareaForm']);
        Route::post('/tareas/create/new', [TareasController::class, 'createTarea']);

        Route::get('/tareas/edit/{id}', [TareasController::class, 'editTareaForm']);
        Route::put('/tareas/edit/{id}/new', [TareasController::class, 'editTarea']);

        Route::delete('/tareas/delete/{id}', [TareasController::class, 'deleteTarea']);

        Route::get('/tareas/show/{id}', [TareasController::class, 'showTarea']);
    });
});

require __DIR__ . '/auth.php';
