<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class boletosModel extends Model
{
     //use HasFactory;
	protected $connection='pgsql';
	protected $table = 'boletos';
	protected $primaryKey = 'bol_id';
	public $incrementing = true;
	#protected $keyType = 'string';

    protected $fillable = [
        'bol_gpoid',
        'bol_gpodate',
        'bol_bolname',
        'bol_cant',
        'bol_tipopago',
        'bol_mail',
        'bol_notas',
    ];
}
