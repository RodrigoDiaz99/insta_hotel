<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');


        $this->call([
            RolesSeeder::class,
            UserSeeder::class, EstablishmentSeeder::class,
            EstablishmentTypeSeeder::class,
            ProveedoresSeeder::class,
            RoomTypeSeeder::class,
            DispositivoSeeder::class, ClienteSeeder::class
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
