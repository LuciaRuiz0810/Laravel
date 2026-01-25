<?php

namespace App\Http\Controllers;

use App\Models\Director;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DirectorController extends Controller
{
    //Función para listar todas las películas
    public function getIndex()
    {
        $directors = Director::all(); //Recoge todas las películas
        return view('admin.indexd', compact('directors')); //Envía a la vista index dentro de admin con movies
    }

    public function  editDirectorForm($id)
    {

        $directors = Director::findOrFail($id);
        return view('admin.editd', compact('directors'));
    }

    //Función que procesa los datos de la edición de esa película
    public function editDirector($id, Request $request)
    {
        //Se validan todos los campos (para que estén rellenos y cumplan con las condiciones, por ejemplo que sea un año)
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'birth_date' => 'required|date|before_or_equal:' . date('Y-m-d'),
            'nationality' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'biography' => 'nullable|string',
        ], [
            //Definición de campos obligatorios con sus respectivos mensajes
            //En la vista se muestra con @error('title')<span style="color: red">{{ $message }}</span>@enderror
            'name.required' => 'El nombre es obligatorio',
            'birth_date.required' => 'El nacimiento es obligatorio',
            'year.integer' => 'El nacimiento debe ser un número',
            'biography.required' => 'La biografía es obligatoria'
        ]);

        try {
            //Se busca la pelicula con ese id
            $Director = Director::findOrfail($id);

            // Si se sube nueva imagen
            if ($request->hasFile('photo')) {
                // Eliminar imagen anterior si existe
                if ($Director->photo) {
                    Storage::disk('public')->delete($Director->photo);
                }

                // Guardar nueva imagen en poster
                $posterPath = $request->file('photo')->store('photo', 'public');
                $validated['photo'] = $posterPath;
            }

            $Director->update($validated);
            //Redirige con mensaje de éxito
            return redirect("/directors")->with('success', 'Director editado correctamente!');
        } catch (Exception) {
            return redirect()->back() //Devuelve a la página anterior
                ->with('error', 'Error al editar al director'); //Se envía con un mensaje de error
        }
    }


    public function delete($id)
    {
        try {
            $director = Director::findOrFail($id);

            // Eliminar la foto del storage
            if ($director->photo) {
                Storage::disk('public')->delete($director->photo);

                //Eliminar foto de la bbdd
                $director->photo = null;
                $director->save();
            }
            return redirect("/directors")->with('success', 'Director editado correctamente!');
        } catch (Exception) {
            return redirect()->back() //Devuelve a la página anterior
                ->with('error', 'Error al eliminar al director'); //Se envía con un mensaje de error
        }
    }
}
