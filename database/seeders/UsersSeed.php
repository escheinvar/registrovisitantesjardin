<?php

namespace Database\Seeders;

use App\Models\catRolesModel;
use App\Models\User;
use App\Models\UserRolesModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ##################################################################################
        ################################################################### Crea usuarios
        $events=[
            [
                'name'=>'admin',
                'act'=>'1',
                'email'=>'admin@jardinoaxaca.mx',
                'password'=>Hash::make('admin')
            ],
            [
                'name'=>'Coordina recorridos',
                'act'=>'1',
                'email'=>'recorridos@jardinoaxaca.mx',
                'password'=>Hash::make('recorridos')
            ],

        ];
        foreach ($events as $event){
            User::create($event);
        }

        ################################################################################
        ####################################################### Crea catálogo de roles
        $events=[
            ['crol_rol'=>'admin',       'crol_describe'=>'Persona administradora del sistema'],
            ['crol_rol'=>'recorridos',  'crol_describe'=>'Persona coordinadora de recorridos'],
            ['crol_rol'=>'escolares',   'crol_describe'=>'Persona coordinadora de recorridos escolares'],
            ['crol_rol'=>'guia',        'crol_describe'=>'Persona guia de recorridos'],
            ['crol_rol'=>'supervisor',        'crol_describe'=>'Persona guia de recorridos'],
        ];
        foreach ($events as $event){
            catRolesModel::create($event);
        }

        ###############################################################################
        ####################################################### Asigna roles a usuarios
        $events=[
            ['rol_email'=>'admin@jardinoaxaca.mx',        'rol_rol'=>'admin'],
            // ['rol_email'=>'admin@jardinoaxaca.mx',        'rol_rol'=>'recorridos'],
            // ['rol_email'=>'admin@jardinoaxaca.mx',        'rol_rol'=>'escolares'],
            // ['rol_email'=>'admin@jardinoaxaca.mx',        'rol_rol'=>'guia'],
            ['rol_email'=>'recorridos@jardinoaxaca.mx', 'rol_rol'=>'recorridos'],
        ];
        foreach ($events as $event){
            UserRolesModel::create($event);
        }
    }
}
