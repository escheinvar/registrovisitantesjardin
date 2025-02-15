<?php

namespace Database\Seeders;

use App\Models\guiasModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GuiasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events=[
            'Aún sin definir',
            'Geovanny',
            'Vianney',
            'Miriam',
            'Jaquie',
            'Abdiel',
            'David',
            'Erick',
            'Epifania',

            'Xitlali',
            'Niza',
            'Mariana',
            'Enrique',

            'Recorrido',
            'Guia1',
            'Guia2',
            'Guia3',
        ];

        foreach ($events as $event){
            guiasModel::create(['guia_name'=>$event]);
        }
    }
}
