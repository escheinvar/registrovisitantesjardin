<?php

namespace Database\Seeders;

use App\Models\tipoBoletoModel;
use App\Models\tipoGpoModel;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            #### Genera catálogos
            UsersSeed::class,
            GuiasSeeder::class,
            tipoBoletoSeeder::class,
            tipoGpoSeeder::class,

            #boletosSeeder::class,
        ]);

        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
