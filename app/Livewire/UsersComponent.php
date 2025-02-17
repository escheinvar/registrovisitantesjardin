<?php

namespace App\Livewire;

use App\Models\catRolesModel;
use App\Models\User;
use App\Models\UserRolesModel;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;
use Livewire\Component;

class UsersComponent extends Component
{
    public $NvoId,$NvoAct,$NvoNombre, $NvoMail,$NvoRoles, $Password,$Password2, $verCampo,$CambiaPass;

    public function mount(){
        $this->verCampo='';
    }

    public function MandarDato($tipo){
        if($tipo=='nuevo'){
            $this->verCampo="nuevo";
            $this->CambiaPass=TRUE;
            $this->NvoId='0';
            $this->NvoAct=TRUE;
            $this->NvoNombre='';
            $this->NvoMail='';
            $this->NvoRoles=[];
        }else{
            $this->verCampo="editar";
            $this->CambiaPass=FALSE;
            $mail=User::where('id',$tipo)->value('email');
            $roles=UserRolesModel::where('rol_email',$mail)->where('rol_act','1')->pluck('rol_rol')->toArray();
            $this->NvoId=$tipo;
            $this->NvoNombre=User::where('id',$tipo)->value('name');
            $act=User::where('id',$tipo)->value('act');
            if($act=='1'){$this->NvoAct=TRUE;}else{$this->NvoAct=FALSE;}
            $this->NvoMail=$mail;
            $this->NvoRoles=$roles;
        }
    }

    public function GuardaOcreaUsr(){
        ##### Valida campos
        $this->validate([
            'NvoNombre'=>'required',
            'NvoMail'=>'required|unique:users,email,'.$this->NvoId.',id'
        ]);
        ##### En caso de, valida password
        if($this->verCampo=='nuevo' OR $this->CambiaPass==TRUE){
            $this->validate([
                'Password'=>'required',
                'Password2'=>'required_with:Password|same:Password',
            ]);
        }
        ##### Crea o edita campos
        User::updateOrCreate(['id'=>$this->NvoId, 'email'=>$this->NvoMail],[
            'name'=>$this->NvoNombre,
            'act'=>$this->NvoAct,
            'email'=>$this->NvoMail,
        ]);
        ##### En caso de, cambia o crea password
        if($this->verCampo=='nuevo' OR $this->CambiaPass==TRUE){
            User::where('id',$this->NvoId)->update([
                'password'=>Hash::make($this->Password),
            ]);
        }
        ###### Inactiva todos los roles existentes
        UserRolesModel::where('rol_email',$this->NvoMail)->update(['rol_act'=>'0']);
        foreach($this->NvoRoles as $rol){
            UserRolesModel::create([
                'rol_act'=>'1',
                'rol_email'=>$this->NvoMail,
                'rol_rol'=>$rol,
            ]);
        }
        redirect('/usuarios');
    }

    public function render() {
        return view('livewire.users-component',[
            'user'=>User::orderBy('name','asc')->orderBy('id','asc')->get(),
            'roles'=>UserRolesModel::where('rol_act','1')->get(),
            'catrol'=>catRolesModel::all(),
        ]);
    }
}
