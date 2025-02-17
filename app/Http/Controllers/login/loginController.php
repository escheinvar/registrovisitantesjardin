<?php

namespace App\Http\Controllers\login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserRolesModel;
use Illuminate\Support\Facades\Auth;


class loginController extends Controller
{
    public function index(){
        $user=Auth::user();
        if($user){
            return redirect('home');
        }else{
            return view('login/login',['mensaje'=>'',]);
        }
    }

    public function store(Request $request){

        $request->session()->regenerate();
        ##### Valida cuestionario
        $request->validate([
            'correo'=>'required',
            'contrasenia'=> 'required',
        ]);

        $credentials = [
            'email' => $request->correo,
            'password' => $request->contrasenia,
        ];
        $remember= $request->dejarActiva;

        ##### Autentica contra directorio activo
        if(Auth::attempt($credentials, $remember)) {
            $user=Auth::user();
            $roles=UserRolesModel::where('rol_act','1')->where('rol_email', $user->email)->pluck('rol_rol')->toArray();
            #$roles2=implode(',',$roles);

            ##### Guarda variables de usuario,
            session([
                'rol'=>$roles,
                'locale'=>'es',
                'localeid'=>'esp',
            ]);
            #### Redirecciona
            return redirect('/home');

        }else{
            return view('login/login',['mensaje'=>'Credenciales erróneas']);

        }
        return view('login/login',['mensaje'=>'Error']);

    }
}
