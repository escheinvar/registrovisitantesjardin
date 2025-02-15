<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tipoGpoModel extends Model
{
    //use HasFactory;
	protected $connection='pgsql';
	protected $table = 'cat_tipo_gpo';
	protected $primaryKey = 'cgpo_id';
	public $incrementing = true;
	#protected $keyType = 'string';

    protected $fillable = [
        'cgpo_act',
        'cgpo_name',
        'cgpo_describe',
    ];
}
