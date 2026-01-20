<?php

namespace App\Http\Controllers;

use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use App\Models\Movie;

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
}
