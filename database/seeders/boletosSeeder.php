<?php

namespace Database\Seeders;

use App\Models\boletosModel;
use App\Models\gruposModel;
use App\Models\guiasModel;
use App\Models\tipoBoletoModel;
use App\Models\tipoGpoModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class boletosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $Dias=1;
        $tipos=tipoBoletoModel::where('bol_act','1')->pluck('bol_name')->toArray();

        while($Dias <= 5){
            $Dias++;
            $fecha= date('Y-m-d',(strtotime (+$Dias.' day' , strtotime(date('Y-m-d')) ) ));
            $count=0;
            $NumGpos=1;
            while($NumGpos <= 4){
                $NumGpos++;
                ###### Grupos
                $gpoId=gruposModel::create([
                    'gpo_cerrado'=>'1',
                    'gpo_date'=>$fecha,
                    'gpo_num'=>$count,
                    'gpo_cgponame'=>fake()->randomElement(tipoGpoModel::where('cgpo_act','1')->pluck('cgpo_name')->toArray(),1),
                    'gpo_guianame'=>fake()->randomElement(guiasModel::where('guia_act','1')->pluck('guia_name')->toArray(),1 ),
                    'gpo_ini_reg'=>$fecha." ".date('H:i:s'),
                    'gpo_fin_reg'=>$fecha." ".date('H:i:s',(strtotime('+15 minutes', strtotime(date('H:i:s'))))),
                ]);
                $NumBoletos=1;

                while($NumBoletos <= 8){
                    $NumBoletos++;
                    ######### Boletos
                    boletosModel::create([
                        'bol_gpoid'=>$gpoId->gpo_id,
                        'bol_gpodate'=>$fecha,
                        'bol_bolname'=>fake()->randomElement($tipos,1),
                        'bol_cant'=>fake()->numberBetween(1,10),
                        'bol_tipopago'=>'ef',
                    ]);
                }
            }
        }
    }
}
