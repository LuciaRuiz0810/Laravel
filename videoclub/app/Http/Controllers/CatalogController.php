<?php

namespace App\Http\Controllers;

use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use App\Models\Movie;
use Exception;
use SebastianBergmann\Environment\Console;

class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    /**
     * Devuelve todo el arrayPeliculas
     *
     *  @return \Illuminate\View\View
     *
     */
    public function getIndex()
    {   //Seleccioona todos los registros

        $movies = Movie::all();


        return view('catalog.index', compact('movies'));
    }
    /**
     * Show the form for creating a new resource.
     * 
     * 
     * @return \Illuminate\View\View
     */
    public function getCreate()
    {

        return view('catalog.create');
    }

    /**
     * Creación de una nueva pelicula dentro de la base de datos
     * 
     * @param \Illuminate\Http\Request 
     * @param \Illuminate\Http\RedirectResponse
     */
    public function postCreate(Request $request)
    {
        //Se validan todos los campos (para que estén rellenos y cumplan con las condiciones, por ejemplo que sea un año)
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'director' => 'required|string|max:255',
            'poster' => 'nullable|url',
            'synopsis' => 'nullable|string',
            'rented' => 'nullable|boolean'
        ], [
            //Definición de campos obligatorios con sus respectivos mensajes
            //En la vista se muestra con @error('title')<span style="color: red">{{ $message }}</span>@enderror
            'title.required' => 'El título es obligatorio',
            'year.required' => 'El año es obligatorio',
            'year.integer' => 'El año debe ser un número',
            'director.required' => 'El director es obligatorio'
        ]);

        try {
            //Se crea directamente el objeto con los datos validados
            $movie = new Movie($validated);
            $movie->save();

            //Redirige con mensaje de éxito
            return redirect('/catalog')->with('success', 'Película añadida correctamente!');
        } catch (Exception $e) {
            return redirect()->back() //Devuelve a la página anterior
                ->withInput() //Se combina con old{{}} para recuperar los datos escritos
                ->with('error', 'Error al guardar la película'); //Se envía con un mensaje de error
        }
    }


    /**
     * Display the specified resource.
     * 
     * @param string $id
     * @return \Illuminate\View\View
     * 
     * Devuelve el contenido de esa pelicula con ese id y su id
     */
    public function getShow(string $id)
    {
        //Encuentra la pelicula con ese id, sino lanza una excepción 
        $movies = Movie::findOrfail($id);
        return view('catalog.show', compact('movies'));
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * @param string $id
     * @return \Illuminate\View\View
     */
    public function getEdit(string $id)
    {
        //Encuentra la pelicula con ese id, sino lanza una excepción 
        $movies = Movie::findOrfail($id);
        return view('catalog.edit', compact('movies'));
    }

    /**
     * Función que actualiza los datos de la película
     * 
     * @param string $id
     * @param \Illuminate\Http\Request 
     * @param \Illuminate\Http\RedirectResponse
     */
    public function putEdit($id, Request $request)
    {

        //Se validan todos los campos (para que estén rellenos y cumplan con las condiciones, por ejemplo que sea un año)
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'director' => 'required|string|max:255',
            'poster' => 'nullable|url',
            'synopsis' => 'nullable|string',
            'rented' => 'nullable|boolean'
        ], [
            //Definición de campos obligatorios con sus respectivos mensajes
            //En la vista se muestra con @error('title')<span style="color: red">{{ $message }}</span>@enderror
            'title.required' => 'El título es obligatorio',
            'year.required' => 'El año es obligatorio',
            'year.integer' => 'El año debe ser un número',
            'director.required' => 'El director es obligatorio'
        ]);

        try {
            //Se busca la pelicula con ese id
            $movies = Movie::findOrfail($id);

            $movies->update($validated); //Actualiza el registro con los nuevos valores validados
            $movies->save();

            //Redirige con mensaje de éxito
            return redirect("/catalog/show/{$id}")->with('success', 'Película actualizada correctamente!');
        } catch (Exception $e) {
            return redirect("/catalog/show/{$id}") 
                ->with('error', 'Error al actualizar la película'); //Se envía con un mensaje de error
        }
    }
}
