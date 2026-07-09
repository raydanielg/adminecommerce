<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $total = 20000;
        $chunk = 1000;

        for ($i = 0; $i < $total; $i += $chunk) {
            Review::factory()->count($chunk)->create();
        }
    }
}
