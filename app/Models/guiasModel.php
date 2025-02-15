<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class guiasModel extends Model
{
    //use HasFactory;
	protected $connection='pgsql';
	protected $table = 'cat_guias';
	protected $primaryKey = 'guia_id';
	public $incrementing = true;
	#protected $keyType = 'string';

    protected $fillable = [
        'guia_act',
        'guia_name',
    ];
}
