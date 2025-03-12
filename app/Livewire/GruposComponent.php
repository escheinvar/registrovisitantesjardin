<?php

namespace App\Livewire;

use App\Models\boletosModel;
use App\Models\gruposModel;
use App\Models\guiasModel;
use App\Models\tipoGpoModel;
use Livewire\Component;

class GruposComponent extends Component
{
    public $abierto, $verNvoGpo;
    public $numero, $gpo, $guia, $notas;

    public function mount(){
        $this->gpo='Aún sin definir';
        $this->guia='Aún sin definir';
        $this->verNvoGpo='0';

        ###### Detecta y cierra grupos abiertos del día anterior
        $hoy=date('Y-m-d');
        gruposModel::where('gpo_cerrado','0')
            ->where('gpo_date','!=',$hoy)
            ->update([
                'gpo_cerrado'=>'1',
                'gpo_fin_reg'=>date('Y-m-d H:i:s'),
            ]);
    }


    public function verGrupo($valor){
        $this->verNvoGpo=$valor;
    }

    public function GeneraGrupo(){
        gruposModel::create([
            'gpo_date'=>date('Y-m-d'),
            'gpo_cerrado'=>'0',
            'gpo_num'=>$this->numero,
            'gpo_cgponame'=>$this->gpo,
            'gpo_guianame'=>$this->guia,
            'gpo_ini_reg'=>date('Y-m-d H:i:s'),
            'gpo_notas_reg'=>$this->notas,
        ]);
        redirect('/grupos');
    }

    public function render() {
        ##### Obtiene la fecha de hoy
        $fecha=[
            'anio'=>date('Y'),'mes'=>date('n'),'dia'=>date('j'),
            'sem'=>date('N'),
            'meses'=>['0','enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre'],
            'semana'=>['0','lunes','martes','miercoles','jueves','viernes','sábado','domingo']
        ];

        ##### Calcula el número de gente por recorrido:
        // $NumGente=boletosModel::selectRaw('bol_gpoid, sum(bol_cant) as suma, gpo_date')
        //     ->groupBy('bol_gpoid','gpo_date')
        //     ->join('grupos','bol_gpoid','=','gpo_id')
        //     ->where('gpo_date',date('Y-m-d'))
        //     ->get();
        // dd($NumGente->where('bol_gpoid','2')->value('suma'));

        ##### Obtiene grupos del día de hoy
        $grupos=gruposModel::where('gpo_date', date('Y-m-d'))->get();

        ##### Obtiene grupos abiertos de hoy
        $gruposAbiertos=$grupos->where('gpo_cerrado','0');

        ##### Tipo de grupo para menú
        $tipoGrupo=tipoGpoModel::where('cgpo_act','1')->get();

        ##### Lista de   guias para menú.
        $guias=guiasModel::where('guia_act','1')->get();

        ##### Asigna número de grupo
        $this->numero= $grupos->count() + 1;

        return view('livewire.grupos-component',[
            'fecha'=>$fecha,
            'grupos'=>$grupos,
            'tiposGpo'=>$tipoGrupo,
            'guias'=>$guias,
            'gruposAbiertos'=>$gruposAbiertos,

        ]);
    }
}
