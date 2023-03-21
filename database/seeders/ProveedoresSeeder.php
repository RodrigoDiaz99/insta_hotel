<?php

namespace Database\Seeders;

use App\Models\Proveedores;
use Illuminate\Database\Seeder;

class ProveedoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Proveedores::create([
            'nombre' => 'Coca-Cola',
            'direccion' => 'C. 1, México, 97143 Mérida, Yuc.',
            'numero' => '+52 999 738 5555',
            'establishment_id' => '1',
        ]);
    }
}
