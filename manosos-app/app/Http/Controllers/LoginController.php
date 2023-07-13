<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class LoginController extends Controller
{

    public function send_data(Request $request)
    {

        $user = new User;
        $usuario = $user::where('nombre', '=', $request->input('user_id'))->first();    
        
        if($usuario == null){
            return redirect()->route('login', ["status" => "Usuario no existe"]);
        }

        if($usuario->password != $request->input('password') ){
            return redirect()->route('login', ["status" => "usuario o clave invalida"]);
        }else{
            //si es valido
            session()->regenerate();
            session(['user_id' => $usuario->id]);
            session(['perfil' => $usuario->perfil]);
            session(['user_name' => $usuario->nombre]);

            return redirect()->route('profile');
            
        }
        
    }
      
    public function sign_in(Request $request)
    {
        $user = new User;
        $usuario = $user::where('nombre', '=', $request->input('user_id'))->first();    
        //validar que no exista
        if($usuario != null){
            return redirect()->route('login', ["status" => "Usuario ya existe"]);
        }

        $user->nombre = $request->input('user_id');
        $user->password = $request->input('password');
        $user->perfil = 2;
        $user->correo = $request->input('correo');
        $user->save();
        return redirect()->route('login', ["status" => "registrado ok"]);
    }

    public function log_out(Request $request)
    {
        Session::flush();
        Session::regenerate();
        return view('login');
    }

}
