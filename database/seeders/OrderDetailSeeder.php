<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderDetail;

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $total = 10000;
        $chunk = 1000;

        for ($i = 0; $i < $total; $i += $chunk) {
            OrderDetail::factory()->count($chunk)->create();
        }
    }
}
