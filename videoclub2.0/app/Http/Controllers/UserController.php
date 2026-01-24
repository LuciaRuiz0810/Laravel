<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\videoclub_dos;
use Exception;

class UserController extends Controller
{


    function listadoUsers(){

    $users = User::all();
    return view('admin.user', compact('users'));

    }
    //Se alquila la pelicula asignando el usuario y cambiando rented a true
    function alquilarPelicula($id_peli, Request $request)
    {
        try {
            $user = $request->user();
            $user->refresh();

            $pelicula = videoclub_dos::findOrFail($id_peli);

            $pelicula->update([
                'id_usuario' => $user->id,
                'rented' => true
            ]);


            $peliculas = $user->RentedMovies ?? [];
            $peliculas[] = $pelicula->id;
            $user->RentedMovies = $peliculas;
            $user->save();



            return redirect("/movie/show/$pelicula->id")->with('success', 'Película alquilada correctamente!');
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->back() //Devuelve a la página anterior
                ->with('error', 'Error al alquilar la película'); //Se envía con un mensaje de error
        }
    }

    //Devuelve la pelicula y cambia los campos a nulos
    function devolverPelicula($id_peli)
    {
        try {

            $pelicula = videoclub_dos::findOrFail($id_peli);
            $pelicula->update([
                'id_usuario' => null,
                'rented' => false
            ]);

            $pelicula->save();
            return redirect("/movie/show/$pelicula->id")->with('success', 'Película devuelta correctamente!');
        } catch (Exception) {
            return redirect()->back() //Devuelve a la página anterior
                ->with('error', 'Error al devolver la película'); //Se envía con un mensaje de error
        }
    }
}
