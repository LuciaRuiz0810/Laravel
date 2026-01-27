<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MoviesController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\Admin;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DirectorController;
use App\Models\videoclub_dos;

Route::middleware('auth')->group(function () { //Grupo de rutas a las que puede acceder el admin y usuarios normales

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/profile/image', [ProfileController::class, 'deleteProfileImage'])->name('profile.image.delete');

    Route::redirect('', '/index'); //Redirige de / a /index
    Route::get('/index', [MoviesController::class, 'getIndex']);

    Route::get('/movie/show/{id}', [MoviesController::class, 'showMovie']);

    Route::put('/rent/movie/{id}', [UserController::class, 'alquilarPelicula']);
    Route::put('/return/movie/{id}', [UserController::class, 'devolverPelicula']);

    Route::middleware([Admin::class])->group(function () { //Grupo de rutas a las que solo puede acceder el Admin

        Route::get('/create/movie', [MoviesController::class, 'createMovieForm']);
        Route::post('/create/movie/new', [MoviesController::class, 'createMovie']);

        Route::get('/edit/movie/{id}', [MoviesController::class, 'editMovieForm']);
        Route::put('/edit/movie/{id}/new', [MoviesController::class, 'editMovie']);

        Route::delete('/delete/movie/{id}', [MoviesController::class, 'delete']);

        Route::get('/alquiladas/user/{id}', [MoviesController::class, 'showAlquiladas']);


        Route::get('/user', [UserController::class, 'listadoUsers']);


        Route::get('/edit/user/{id}', [UserController::class, 'editUserForm']);
        Route::put('/edit/user/{id}/new', [UserController::class, 'editUser']);


        Route::delete('/delete/user/{id}', [UserController::class, 'delete']);

        Route::get('/directors', [DirectorController::class, 'getIndex']);

        Route::put('/director/edit/{id}/new', [DirectorController::class, 'editDirector']);
        Route::get('/director/edit/{id}', [DirectorController::class, 'editDirectorForm']);
        Route::delete('/actors/image/{id}', [DirectorController::class, 'delete']);
    });
});

require __DIR__ . '/auth.php';
