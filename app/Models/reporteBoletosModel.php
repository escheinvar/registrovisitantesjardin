<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class reporteBoletosModel extends Model
{
    //use HasFactory;
	protected $connection='pgsql';
	protected $table = 'reporte_boletos';
	#protected $primaryKey = 'guia_id';
	#public $incrementing = true;
	#protected $keyType = 'string';

}
