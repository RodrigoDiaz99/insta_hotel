<?php

namespace Database\Seeders;

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Kenn Enrique Ayala Valladares',
            'email' => 'it@domain.com',
            'phone' => '9999999999',
            'password' => Hash::make('Pedro41217'),

        ])->assignRole('Super-Admin');

        User::create([
            'name' => 'Rodrigo Diaz Serviran',
            'email' => 'it2@domain.com',
            'phone' => '9999999998',
            'password' => Hash::make('Rodrigo2012')
        ])->assignRole('Super-Admin');

        User::create([
            'name' => 'Juan Mézquita',
            'email' => 'guest@easypisos.mx',
            'phone' => '9999999997',
            'password' => Hash::make('123456789')
        ])->assignRole('Guest');
    }
}
