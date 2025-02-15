<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tipoBoletoModel extends Model
{
    //use HasFactory;
	protected $connection='pgsql';
	protected $table = 'cat_tipo_boleto';
	protected $primaryKey = 'bol_id';
	public $incrementing = true;
	#protected $keyType = 'string';

    protected $fillable = [
        'bol_tipo',
        'bol_act',
        'bol_name',
        'bol_costo',
        'bol_explica',
    ];
}
