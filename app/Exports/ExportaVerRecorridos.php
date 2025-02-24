<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportaVerRecorridos implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $fechaIni, $fechaFin;

    public function __construct($fechaIni, $fechaFin){
        $this->fechaIni= $fechaIni;
        $this->fechaFin= $fechaFin;
    }


    public function collection() {
        return DB::table("reporte_boletos")
        ->whereBetween('gpo_date',[$this->fechaIni,$this->fechaFin])
        ->orderBy('bol_gpoid','asc')
        #->when('gpo_cerrado'=='1',function($cambia){ return $cambia->select('gpo_cerrado = `Grupo cerrado` ');})
        #->when('gpo_cerrado'=='0',function($cambia){ return $cambia->select('gpo_cerrado = `Grupo abierto` ');})
        #->select('gpo_date','bol_gpoid','gpo_cgponame','gpo_guianame','gpo_cerrado','bol_bolname','boletos')
        ->select('gpo_date','bol_gpoid','gpo_cgponame','gpo_guianame','gpo_cerrado','bol_bolname','boletos')
        ->get();


        // Client::select('clients.id as client_id', 'clients.firstname', 'clients.lastname')
		// ->when('clients.title_id' == 1, function ($query) {
		// 	return $query->select('clients.title_id as title = `Dr.`'); })
		// ->when('clients.title_id' == 2, function ($query) {
		// 	return $query->select('clients.title_id as title = `Prof.`'); })
		// ->first();
    }
    public function headings():array{
        return['FechaDelRecorrido','IdDelRecorrido','TipoDeRecorrido','NombreDelGuia','GrupoCerrado','TipoDeBoleto','CantidadDeBoletos'];
    }
}
