<?php

namespace App\Livewire;

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

        ##### Obtiene grupos del día de hoy
        $grupos=gruposModel::where('gpo_date', date('Y-m-d'))->get();

        ##### Obtiene grupos abiertos de hoy
        $gruposAbiertos=$grupos->where('gpo_cerrado','0');

        ##### Tipo de grupo para menú
        $tipoGrupo=tipoGpoModel::where('cgpo_act','1')->get();

        ##### Lista de guias para menú.
        $guias=guiasModel::where('guia_act','1')->get();

        ##### Asigna número de grupo
        $this->numero= $grupos->count() + 1;

#dd($grupos,$gruposAbiertos);

        return view('livewire.grupos-component',[
            'fecha'=>$fecha,
            'grupos'=>$grupos,
            'tiposGpo'=>$tipoGrupo,
            'guias'=>$guias,
            'gruposAbiertos'=>$gruposAbiertos,
        ]);
    }
}
