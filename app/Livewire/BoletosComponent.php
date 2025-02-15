<?php

namespace App\Livewire;

use App\Models\boletosModel;
use App\Models\gruposModel;
use App\Models\guiasModel;
use Livewire\Component;

class BoletosComponent extends Component
{

    public $Internacional,$Nacional,$Mayor60,$Menor13,$Profesor,$Estudiante,$Discapacidad;
    public $GpoAbierto, $boletos, $boletoscobro, $cobro, $mail, $notas;
    public $guia, $tipoReco, $GpoSize;

    public function mount(){
         ##### Obtiene el número de grupos abiertos del día de hoy
         $NumGposAbiertos=gruposModel::where('gpo_date', date('Y-m-d'))
            ->where('gpo_cerrado','0')
            ->count();
         if($NumGposAbiertos == 0){
            redirect('/grupos');
        }
        ##### Obtiene datos del grupo abierto
        ##### Obtiene datos del grupo abierto
        $this->GpoAbierto=gruposModel::where('gpo_date', date('Y-m-d'))
            ->where('gpo_cerrado','0')
            ->first();

    }

    public function suma($var){
        if($this->$var==''){$this->$var='0';}
        $this->$var++ ;
    }
    public function resta($var){
        if($this->$var==''){$this->$var='0';}
        $this->$var--;
    }

    public function borrar(){
        $this->Internacional=null;
        $this->Nacional=null;
        $this->Mayor60=null;
        $this->Menor13=null;
        $this->Profesor=null;
        $this->Estudiante=null;
        $this->Discapacidad=null;
        $this->boletos='0';
    }

    public function DarBoletos($tipo){
        $todos=['Internacional','Nacional','Mayor60','Menor13','Profesor','Estudiante','Discapacidad'];
        foreach($todos as $i){
            if($this->$i > 0){
                boletosModel::create([
                    'bol_gpoid'=>$this->GpoAbierto->gpo_id,
                    'bol_bolname'=>$i,
                    'bol_cant'=>$this->$i,
                    'bol_tipopago'=>'ef',
                    'bol_mail'=>$this->mail,
                    'bol_notas'=>$this->notas,
                ]);
            }
            redirect('/boletos');
        }
    }

    public function CerrarGrupo(){
        gruposModel::where('gpo_cerrado','0')->update(['gpo_cerrado'=>'1']);
        redirect('/grupos');
    }

    public function render() {
        ##### Obtiene el número de grupos abiertos del día de hoy
        $NumGposAbiertos=gruposModel::where('gpo_date', date('Y-m-d'))
            ->where('gpo_cerrado','0')
            ->count();

        #### Calculos de boletos, cobros y tamaño del grupo
        $this->boletos= $this->Internacional + $this->Nacional + $this->Mayor60 + $this->Menor13 +$this->Profesor + $this->Estudiante + $this->Discapacidad;
        $this->boletoscobro = ($this->Internacional + $this->Nacional);
        $this->cobro = $this->boletoscobro * 50;

        ##### Calcula número de gente que ya hay dentro del grupo
        $GenteDentro=boletosModel::where('bol_gpoid',$this->GpoAbierto->gpo_id)->sum('bol_cant');


        $this->GpoSize = $GenteDentro + $this->boletos;

        ##### Obtiene datos del grupo abierto
        $this->GpoAbierto=gruposModel::where('gpo_date', date('Y-m-d'))
            ->where('gpo_cerrado','0')
            ->first();

        if($NumGposAbiertos == 0){
            redirect('/grupos');
        }
        ##### Obtiene la fecha de hoy
        $fecha=[
            'anio'=>date('Y'),'mes'=>date('n'),'dia'=>date('j'),
            'sem'=>date('N'),
            'meses'=>['0','enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre'],
            'semana'=>['0','lunes','martes','miercoles','jueves','viernes','sábado','domingo']
        ];

        return view('livewire.boletos-component',[
            'fecha'=>$fecha,
            'guias'=>guiasModel::where('guia_act','1')->select('guia_name')->get(),

        ]);

    }
}
