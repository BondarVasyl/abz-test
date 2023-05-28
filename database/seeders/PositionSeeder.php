<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Security'],
            ['name' => 'Designer'],
            ['name' => 'Content manager'],
            ['name' => 'Lawyer'],
        ];

        foreach ($data as $item) {
            Position::firstOrCreate($item);
        }
    }
}
