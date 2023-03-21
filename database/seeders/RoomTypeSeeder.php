<?php

namespace Database\Seeders;

use App\Models\Room_type;
use Illuminate\Database\Seeder;

class RoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Room_type::create([
            'name' => 'De lujo',
            'establishments_id' => '1'
        ]);
    }
}
