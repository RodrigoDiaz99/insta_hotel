<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Cliente::create([
            'nombre' => 'Kenn Enrique',
            'apellido_p' => 'Ayala',
            'apellido_m' => 'Valladares',
            'fecha_n' => '1998-06-04',
            'genero' => 'Masculino',
            'origen' => 'Mexicano',
            'tipo_documento' => 'INE',
            'documento' => 'AAVK980604',
            'expedicion' => '2018-01-01',
            'pais_documento' => 'México',
            'email' => 'kennayala@easypisos.mx',
            'direccion' => 'C. 15, Col. Ficticia',
            'codigo_postal' => '97200',
            'poblacion' => 'Mérida',
            'provincia' => 'Mérida',
            'telefono_1' => '9992259650',
            'telefono_2' => '9999195373',
            'estado' => 'activo'
        ]);
    }
}
