<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


//Si el usuario no esta loggeado, se redirige a /login, si lo está a /catalog directamente
class HomeController extends Controller
{
    public function getHome(){
       

        if(!Auth::check()){
            return redirect('/login');
        }

        return redirect('/catalog');;
        
}

}