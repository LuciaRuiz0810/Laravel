<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class videoclub_dos extends Model
{
    protected $table = 'movies';

    
    protected $fillable = [
        'title',
        'year',
        'director',
        'poster',
        'synopsis',
        'rented',
        'id_usuario' 
    ];
}
