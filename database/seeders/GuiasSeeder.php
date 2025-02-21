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
            'Recorrido',
            'Alejandro',
            'Geovanny',
            'Vianney',
            'Jaquie',
            'Abdiel',
            'David',
            'Erick',
            'Miriam',
            'Epifania',

            'Xitlali',
            'Niza',
            'Mariana',
            'Enrique',
        ];

        foreach ($events as $event){
            guiasModel::create(['guia_name'=>$event]);
        }
    }
}
