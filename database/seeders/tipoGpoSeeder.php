<?php

namespace Database\Seeders;

use App\Models\tipoGpoModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class tipoGpoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events=[
            ['cgpo_act'=>'1','cgpo_name'=>'Aún sin definir',    'cgpo_describe'=>''],
            ['cgpo_act'=>'1','cgpo_name'=>'Escolar',        'cgpo_describe'=>''],
            ['cgpo_act'=>'1','cgpo_name'=>'Recorrido_español',  'cgpo_describe'=>''],
            ['cgpo_act'=>'0','cgpo_name'=>'Recorrido_inglés',  'cgpo_describe'=>''],
            ['cgpo_act'=>'0','cgpo_name'=>'Recorrido_francés',  'cgpo_describe'=>''],
            ['cgpo_act'=>'0','cgpo_name'=>'Recorrido_alemán',  'cgpo_describe'=>''],
            ['cgpo_act'=>'0','cgpo_name'=>'Recorrido_portugués',  'cgpo_describe'=>''],
            ['cgpo_act'=>'1','cgpo_name'=>'Paseo_gratuito', 'cgpo_describe'=>''],
        ];
        foreach ($events as $event){
            tipoGpoModel::create($event);
        }
    }
}
