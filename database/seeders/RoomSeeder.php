<?php

namespace Database\Seeders;

use App\Models\Schedule\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Room::create([
            'name' => 'Ruang A'
        ]);

        Room::create([
            'name' => 'Ruang B'
        ]);
    }
}
