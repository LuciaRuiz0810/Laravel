<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
     protected $table = 'directors';

    protected $fillable = [
        'name',
        'birth_date',
        'nationality',
        'biography',
        'photo'
    ];
}
