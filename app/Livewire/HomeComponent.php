<?php

namespace App\Livewire;

use App\Models\UserRolesModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class HomeComponent extends Component
{
    public function render()    {
        if(Auth::user()) {
            $user=Auth::user();
            $roles=UserRolesModel::where('rol_act','1')->where('rol_email', $user->email)->pluck('rol_rol')->toArray();

            ##### Guarda variables de usuario,
            session([
                'rol'=>$roles,
            ]);
            return view('livewire.home-component');

        }else{
           redirect('/');
        }
    }
}
