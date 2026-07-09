<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            UserSeeder::class,
            ShopSeeder::class,
            VendorStoreSeeder::class,
            DeliveryManSeeder::class,
            OrderSeeder::class,
            OrderDetailSeeder::class,
            ReviewSeeder::class,
            NewsletterSeeder::class,
            SocialMediaSeeder::class,
            LargeOrderSeeder::class,
        ]);
    }
}
