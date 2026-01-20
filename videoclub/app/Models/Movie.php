<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//Modelo que actua sobre la tabla a través de las migraciones
class Movie extends Model
{
    protected $table = 'movies'; //Los nombres de las tablas en la bbdd deben estar en minus y plural en ingles.
}
