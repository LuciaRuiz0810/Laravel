<?php

namespace App\Http\Controllers;

use App\Http\Models;
use App\Models\Movie;
use App\Models\videoclub_dos;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MoviesController extends Controller
{
    //Función para listar todas las películas
    public function getIndex()
    {
        $movies = videoclub_dos::all(); //Recoge todas las películas
        return view('admin.index', compact('movies')); //Envía a la vista index dentro de admin con movies
    }


    //Funcion para mostrar el Formulario de la creación
    public function createMovieForm()
    {
        return view('admin.create');
    }


    //Función que procesa los datos enviados por el formulario
    public function createMovie(Request $request)
    {
        //Se validan todos los campos (para que estén rellenos y cumplan con las condiciones, por ejemplo que sea un año)
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'director' => 'required|string|max:255',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', //formatos y tamaño de imagen permitidos
            'synopsis' => 'nullable|string',
            'rented' => 'nullable|boolean'
        ], [
            //Definición de campos obligatorios con sus respectivos mensajes
            //En la vista se muestra con @error('title')<span style="color: red">{{ $message }}</span>@enderror
            'title.required' => 'El título es obligatorio',
            'year.required' => 'El año es obligatorio',
            'year.integer' => 'El año debe ser un número',
            'director.required' => 'El director es obligatorio',
            'poster.image' => 'El archivo debe ser una imagen válida',
            'poster.mimes' => 'Los formatos permitidos son: jpeg, png, jpg, gif, webp',
            'poster.max' => 'La imagen no debe superar los 2MB'
        ]);

        //Subir imagen si existe y es válida
        $posterPath = null;
        //Verifica que se haya enviado una imagen, la obtiene(file), y verifica que sea valido
        if ($request->hasFile('poster') && $request->file('poster')->isValid()) {
            $posterPath = $request->file('poster')->store('posters', 'public');
            //Guarda en: storage/app/public/posters/nombre-generado.jpg (Ruta Local)
            //Para que se pueda mostrar la imagen -> php artisan storage:link IMPORTANTE
        }

        try {
            //Se crea el objeto con los datos validados y asignando la ruta de la imagen 
            videoclub_dos::create([
                'title' => $validated['title'],
                'year' => $validated['year'],
                'director' => $validated['director'],
                'poster' => $posterPath, // Guarda la ruta relativa
                'synopsis' => $validated['synopsis'],
            ]);


            //Redirige con mensaje de éxito a index
            return redirect('/index')->with('success', 'Película añadida correctamente!');
        } catch (Exception) {
            return redirect()->back() //Devuelve a la página anterior
                ->withInput() //Se combina con old{{}} para recuperar los datos escritos
                ->with('error', 'Error al guardar la película'); //Se envía con un mensaje de error
        }
    }


    //Función para mostrar los detalles de la película escogida
    public function showMovie($id)
    {
        $movies = videoclub_dos::findOrFail($id); //Busca la pelicula con ese id, sino lanzará excepción
        return view('admin.show', compact('movies'));
    }


    //Función para mostrar el formulario correspondiente para editar la pelicula
    public function editMovieForm($id)
    {
        $movies = videoclub_dos::findOrFail($id);
        return view('admin.edit', compact('movies'));
    }


    //Función que procesa los datos de la edición de esa película
    public function editMovie($id, Request $request)
    {
        //Se validan todos los campos (para que estén rellenos y cumplan con las condiciones, por ejemplo que sea un año)
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'director' => 'required|string|max:255',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
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
            $movies = videoclub_dos::findOrfail($id);

            // Si se sube nueva imagen
            if ($request->hasFile('poster')) {
                // Eliminar imagen anterior si existe
                if ($movies->poster) {
                    Storage::disk('public')->delete($movies->poster);
                }

                // Guardar nueva imagen en poster
                $posterPath = $request->file('poster')->store('posters', 'public');
                $validated['poster'] = $posterPath;
            }

            $movies->update($validated);
            //Redirige con mensaje de éxito
            return redirect("/index")->with('success', 'Película editada correctamente!');
        } catch (Exception) {
            return redirect()->back() //Devuelve a la página anterior
                ->with('error', 'Error al editada la película'); //Se envía con un mensaje de error
        }
    }


    //Función que elimina la pelicula con ese id
    public function delete($id)
    {
        try {
            $movie = videoclub_dos::findOrFail($id);
            $movie->delete();


            // Eliminar imagen del storage
            if ($movie->poster) {
                Storage::disk('public')->delete($movie->poster);
            }

            //Redirige con mensaje de éxito
            return redirect("/index")->with('success', 'Pelicula eliminada correctamente!');
        } catch (Exception) {
            return redirect()->back() //Devuelve a la página anterior
                ->with('error', 'Error al eliminar la Pelicula'); //Se envía con un mensaje de error
        }
    }
}
