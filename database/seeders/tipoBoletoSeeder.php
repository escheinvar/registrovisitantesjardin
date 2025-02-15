<?php

namespace Database\Seeders;

use App\Models\tipoBoletoModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class tipoBoletoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events=[
            ['bol_tipo'=>'c','bol_name'=>'Nacional',    'bol_costo'=>'50.0','bol_explica'=>''],
            ['bol_tipo'=>'c','bol_name'=>'Internacional','bol_costo'=>'50.0','bol_explica'=>''],

            ['bol_tipo'=>'g','bol_name'=>'Mayor60',     'bol_costo'=>'0','bol_explica'=>''],
            ['bol_tipo'=>'g','bol_name'=>'Menor13',     'bol_costo'=>'0','bol_explica'=>''],
            ['bol_tipo'=>'g','bol_name'=>'Profesor',    'bol_costo'=>'0','bol_explica'=>''],
            ['bol_tipo'=>'g','bol_name'=>'Estudiante',  'bol_costo'=>'0','bol_explica'=>''],
            ['bol_tipo'=>'g','bol_name'=>'Discapacidad','bol_costo'=>'0','bol_explica'=>''],
        ];
        foreach ($events as $event){
            tipoBoletoModel::create($event);
        }
    }
}
