<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Exception;
use Illuminate\Http\Request;

class TareasController extends Controller
{
    public function getIndex()
    {
        $array_listado_tareas = Tarea::all();
        return view('tareas.index', compact('array_listado_tareas'));
    }

     public function getIndexUser()
    {
        $array_listado_tareas = Tarea::all();
        return view('user.index', compact('array_listado_tareas'));
    }


    public function createTareaForm()
    {
        return view('tareas.create');
    }

    public function createTarea(Request $request)
    {
        //Se debe añadir  protected $fillable = ['nombre', 'estado', 'responsable']; en el modelo
        //Se validan todos los campos (para que estén rellenos y cumplan con las condiciones)
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'estado' => 'required|string|max:255',
            'responsable' => 'required|string|max:255'

        ], [
            //Definición de campos obligatorios con sus respectivos mensajes
            //En la vista se muestra con @error('title')<span style="color: red">{{ $message }}</span>@enderror
            'nombre.required' => 'El nombre es obligatorio',
            'responsable.required' => 'El responsable es obligatorio',

        ]);

        try {
            //Se crea directamente el objeto con los datos validados
            $tarea = new Tarea($validated);
            $tarea->save();

            //Redirige con mensaje de éxito
            return redirect('/index')->with('success', 'Tarea añadida correctamente!');
        } catch (Exception) {
            return redirect()->back() //Devuelve a la página anterior
                ->withInput() //Se combina con old{{}} para recuperar los datos escritos
                ->with('error', 'Error al guardar la tarea'); //Se envía con un mensaje de error
        }
    }

    public function editTareaForm($id)
    {
        $tarea = Tarea::findOrfail($id);
        return view('tareas.edit', compact('tarea'));
    }

    public function editTarea($id, Request $request)
    {

        $tarea = Tarea::findOrfail($id);
        //Se debe añadir  protected $fillable = ['nombre', 'estado', 'responsable']; en el modelo
        //Se validan todos los campos (para que estén rellenos y cumplan con las condiciones)
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'estado' => 'required|string|max:255',
            'responsable' => 'required|string|max:255'

        ], [
            //Definición de campos obligatorios con sus respectivos mensajes
            //En la vista se muestra con @error('nombre')<span style="color: red">{{ $message }}</span>@enderror
            'nombre.required' => 'El nombre es obligatorio',
            'responsable.required' => 'El responsable es obligatorio',

        ]);

        try {
            //Se crea directamente el objeto con los datos validados
            $tarea->update($validated); //Actualiza el registro con los nuevos valores validados$tarea = new Tarea($validated);
            $tarea->save();

            //Redirige con mensaje de éxito
            return redirect("/index")->with('success', 'Tarea modificada correctamente!');
        } catch (Exception) {
            return redirect()->back() //Devuelve a la página anterior
                ->with('error', 'Error al modificar la tarea'); //Se envía con un mensaje de error
        }
    }

    public function deleteTarea($id)
    {
        try {
            $tarea = Tarea::findOrFail($id);

            $tarea->delete();

            //Redirige con mensaje de éxito
            return redirect("/index")->with('success', 'Tarea eliminada correctamente!');
        } catch (Exception) {
            return redirect()->back() //Devuelve a la página anterior
                ->with('error', 'Error al eliminar la tarea'); //Se envía con un mensaje de error
        }
    }

    public function showTarea($id){

        $tarea = Tarea::findOrFail($id);

        return view('tareas.show', compact('tarea'));
    }

    public function showTareaUser($id){

        $tarea = Tarea::findOrFail($id);

        return view('user.show', compact('tarea'));
    }

}
