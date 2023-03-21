<?php

namespace Database\Seeders;

use App\Models\TipoDispositivo;
use Illuminate\Database\Seeder;

class DispositivoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoDispositivo::create([
            'tipo_dispositivo' => 'Android',
        ]);

        TipoDispositivo::create([
            'tipo_dispositivo' => 'IOS',

        ]);
    }
}
