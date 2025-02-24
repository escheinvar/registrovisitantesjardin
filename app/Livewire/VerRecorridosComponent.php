<?php

namespace App\Livewire;

use App\Exports\ExportaVerRecorridos;
use App\Imports\ImportaDesdeKobo;
use App\Models\boletosModel;
use App\Models\gruposModel;
use App\Models\reporteBoletos;
use App\Models\reporteBoletosModel;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class VerRecorridosComponent extends Component
{
    public $fechaIni,$fechaFin, $order,$sent, $DesdeKobo;

    public function mount(){
        $this->fechaIni=date('Y-m-d');
        $this->fechaFin=date('Y-m-d');
        $this->order='gpo_id';
        $this->sent='asc';
    }

    public function ordenar($campo){
        $this->order=$campo;
        if($this->sent=='asc'){
            $this->sent='desc';
        }else{
            $this->sent='asc';
        }
    }

    public function Exportar(){
        return Excel::download(new ExportaVerRecorridos($this->fechaIni,$this->fechaFin),
            'Salida.csv',
            \Maatwebsite\Excel\Excel::CSV,
            ['Content-Type'=>'text/csv']);
    }

    public function Importar(){
        Excel::import(new ImportaDesdeKobo, request()->file('DesdeKobo'));
        return back();
    }

    public function render(){
        $grupos=gruposModel::whereBetween('gpo_date',[$this->fechaIni,$this->fechaFin])
            ->orderBy($this->order,$this->sent)
            ->get();

        $boletos=DB::table("reporte_boletos")
        ->whereBetween('gpo_date',[$this->fechaIni,$this->fechaFin])
        ->get();

        #dd($boletos,$this->fechaIni, $this->fechaFin);
        return view('livewire.ver-recorridos-component',[
            'boletos'=>$boletos,
            'grupos'=>$grupos,
        ]);
    }
}
