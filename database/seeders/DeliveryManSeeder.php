<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeliveryManSeeder extends Seeder
{
    /**
     * Run the database seeds for demo delivery men.
     *
     * @return void
     */
    public function run()
    {
        $zone = DB::table('zones')->first();
        $zoneId = $zone ? $zone->id : null;

        $deliveryMen = [
            [
                'id' => 101,
                'f_name' => 'David',
                'l_name' => 'Rider',
                'email' => 'delivery1@demo.com',
                'phone' => '+101566666666',
            ],
            [
                'id' => 102,
                'f_name' => 'Sarah',
                'l_name' => 'Rider',
                'email' => 'delivery2@demo.com',
                'phone' => '+101577777777',
            ],
            [
                'id' => 103,
                'f_name' => 'Tom',
                'l_name' => 'Rider',
                'email' => 'delivery3@demo.com',
                'phone' => '+101588888888',
            ],
            [
                'id' => 104,
                'f_name' => 'Emma',
                'l_name' => 'Rider',
                'email' => 'delivery4@demo.com',
                'phone' => '+101599999999',
            ],
            [
                'id' => 105,
                'f_name' => 'James',
                'l_name' => 'Rider',
                'email' => 'delivery5@demo.com',
                'phone' => '+1015111111110',
            ],
        ];

        foreach ($deliveryMen as $man) {
            DB::table('delivery_men')->updateOrInsert(
                ['id' => $man['id']],
                [
                    'f_name' => $man['f_name'],
                    'l_name' => $man['l_name'],
                    'phone' => $man['phone'],
                    'email' => $man['email'],
                    'password' => bcrypt(12345678),
                    'identity_number' => 'ID' . $man['id'],
                    'identity_type' => 'passport',
                    'identity_image' => 'def.png',
                    'image' => 'def.png',
                    'zone_id' => $zoneId,
                    'status' => 1,
                    'active' => 1,
                    'application_status' => 'approved',
                    'type' => 'zone_wise',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
