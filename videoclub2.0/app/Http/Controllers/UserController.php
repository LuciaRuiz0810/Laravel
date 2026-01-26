<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\videoclub_dos;
use Exception;

class UserController extends Controller
{

    //Lista todos los usuarios de la bbdd
    function listadoUsers()
    {

        $users = User::all();
        return view('admin.user', compact('users'));
    }

    //Formulario para editar al user
    function editUserForm($id)
    {
        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    //Procesamiento de datos del edit
    function editUser($id, Request $request)
    {
        //Se validan todos los campos (para que estén rellenos y cumplan con las condiciones, por ejemplo que sea un email)
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'role' => 'required',
        ], [
            'name.required' => 'El Nombre es obligatorio',
            'email.required' => 'El email es obligatorio',
            'email.unique' => 'Este correo electrónico ya está registrado por otro usuario.',
            'email.email' => 'Debe ingresar un correo electrónico válido.',
            'role.required' => 'El role es obligatorio'
        ]);


        try {
            //Se busca el usuario con ese id
            $user = User::findOrfail($id);

            $user->update($validated); //Actualiza el registro con los nuevos valores validados

            //Redirige con mensaje de éxito a index
            return redirect('/user')->with('success', 'Usuario editado correctamente!');
        } catch (Exception) {
            return redirect()->back() //Devuelve a la página anterior
                ->with('error', 'Error al editar el usuario'); //Se envía con un mensaje de error
        }
    }

    //Eliminar un usuario
    public function delete($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            //Redirige con mensaje de éxito
            return redirect("/user")->with('success', 'Usuario eliminado correctamente!');
        } catch (Exception) {
            return redirect()->back() //Devuelve a la página anterior
                ->with('error', 'Error al eliminar el usuario'); //Se envía con un mensaje de error
        }
    }

    //Se alquila la pelicula asignando el usuario y cambiando rented a true
    function alquilarPelicula($id_peli, Request $request)
    {
        try {
            $user = $request->user();
            $user->refresh();

            $pelicula = videoclub_dos::findOrFail($id_peli);

            //Añade dentro de id_usuario en pelicula, el usuario que la a alquilado
            $pelicula->update([
                'id_usuario' => $user->id,
                'rented' => true
            ]);

            //Se añade el id de la pelicula al array de usuarios RentedMovies
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
        
        // Obtener el usuario que tiene alquilada la película
        $usuario = User::find($pelicula->id_usuario);
        
        // Actualizar la película
        $pelicula->update([
            'id_usuario' => null,
            'rented' => false
        ]);

        // Eliminar la película del array RentedMovies del usuario
        if ($usuario) {
            $peliculasAlquiladas = $usuario->RentedMovies ?? [];
            
            // Filtrar para eliminar solo esta película del array
            $peliculasAlquiladas = array_filter($peliculasAlquiladas, function($peliId) use ($id_peli) {
                return $peliId != $id_peli;
            });
            
            $usuario->RentedMovies = $peliculasAlquiladas;
            $usuario->save();
        }

        return redirect("/movie/show/$pelicula->id")->with('success', 'Película devuelta correctamente!');
    } catch (Exception) {
        return redirect()->back()
            ->with('error', 'Error al devolver la película');
    }
}
}
