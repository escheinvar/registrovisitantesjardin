<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class gruposModel extends Model
{
    //use HasFactory;
	protected $connection='pgsql';
	protected $table = 'grupos';
	protected $primaryKey = 'gpo_id';
	public $incrementing = true;
	#protected $keyType = 'string';

    protected $fillable = [
        'gpo_id',
        'gpo_date',
        'gpo_num',
        'gpo_cgponame',
        'gpo_guianame',
        'gpo_ini_reg',
        'gpo_fin_reg',
        'gpo_ini_reco',
        'gpo_fin_reco',
        'gpo_notas_reg',
        'gpo_notas_reco',
    ];
}
