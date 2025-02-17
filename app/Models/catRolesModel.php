<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class catRolesModel extends Model
{
    //use HasFactory;
	protected $connection='pgsql';
	protected $table = 'cat_roles_user';
	protected $primaryKey = 'crol_id';
	public $incrementing = true;
	#protected $keyType = 'string';

    protected $fillable = [
        'crol_rol',
        'crol_describe',
    ];
}
