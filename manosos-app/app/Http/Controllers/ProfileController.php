<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function home(Request $request)
    {
        //si es valido
        session()->regenerate();
        
        if(Session::has('user_id')){   
            return view('panel', ['user_name' => Session::get('user_name'), 
                                  'perfil'    => Session::get('perfil')]);
        }else{
            return view('login', ["status" => "Debe iniciar sesión"] );
        }
    }
}
