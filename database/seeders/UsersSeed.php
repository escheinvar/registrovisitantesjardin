<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events=[
            [
                'name'=>'caja',
                'email'=>'caja@jardinoaxaca.mx',
                'rol'=>'caja',
                'password'=>Hash::make('caja')
            ],

        ];

        foreach ($events as $event){
            User::create($event);
        }
    }
}
