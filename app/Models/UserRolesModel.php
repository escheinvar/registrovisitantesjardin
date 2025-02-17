<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRolesModel extends Model
{
     //use HasFactory;
	protected $connection='pgsql';
	protected $table = 'users_roles';
	protected $primaryKey = 'rol_id';
	public $incrementing = true;
	#protected $keyType = 'string';

    protected $fillable = [
        'rol_act',
        'rol_email',
        'rol_rol',
    ];
}
