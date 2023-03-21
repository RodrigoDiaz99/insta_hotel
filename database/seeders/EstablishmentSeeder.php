<?php

namespace Database\Seeders;

use App\Models\Establishment;
use Illuminate\Database\Seeder;

class EstablishmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Establishment::create([
            'name' => 'Hotel Tipton',
            'location' => 'C. 1, México, 97143 Mérida, Yuc.',
            'capacity' => '250',
            'owner' => '2',
            'establishment_types_id' => '1',
            'description' => 'Un Hotel de 24 hrs'
        ]);
        Establishment::create([
            'name' => 'VSuites Mérida',
            'location' => 'C. 4 255, Leandro Valle, 97143 Mérida, Yuc.',
            'capacity' => '250',
            'owner' => '1',
            'establishment_types_id' => '2',
            'description' => 'Un motel de 24 hrs'
        ]);
    }
}
