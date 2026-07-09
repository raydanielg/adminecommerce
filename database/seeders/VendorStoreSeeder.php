<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class VendorStoreSeeder extends Seeder
{
    /**
     * Run the database seeds for additional vendors and stores.
     *
     * @return void
     */
    public function run()
    {
        // Find the shop module, or use the first available module
        $module = DB::table('modules')->where('module_type', 'shop')->first()
            ?? DB::table('modules')->first();

        if (!$module) {
            return;
        }

        $moduleId = $module->id;
        $zone = DB::table('zones')->first();
        $zoneId = $zone ? $zone->id : null;

        $vendors = [
            [
                'id' => 101,
                'f_name' => 'John',
                'l_name' => 'Doe',
                'email' => 'vendor1@shopdemo.com',
                'phone' => '+101533333333',
                'store_name' => 'Electro Shop',
                'store_slug' => 'electro-shop',
            ],
            [
                'id' => 102,
                'f_name' => 'Jane',
                'l_name' => 'Smith',
                'email' => 'vendor2@shopdemo.com',
                'phone' => '+101544444444',
                'store_name' => 'Fashion Hub',
                'store_slug' => 'fashion-hub',
            ],
            [
                'id' => 103,
                'f_name' => 'Mike',
                'l_name' => 'Johnson',
                'email' => 'vendor3@shopdemo.com',
                'phone' => '+101555555555',
                'store_name' => 'Home Essentials',
                'store_slug' => 'home-essentials',
            ],
        ];

        $storeIdBase = 101;

        foreach ($vendors as $index => $vendorData) {
            $vendorId = $vendorData['id'];
            $storeId = $storeIdBase + $index;

            DB::table('vendors')->updateOrInsert(
                ['id' => $vendorId],
                [
                    'f_name' => $vendorData['f_name'],
                    'l_name' => $vendorData['l_name'],
                    'phone' => $vendorData['phone'],
                    'email' => $vendorData['email'],
                    'password' => bcrypt(12345678),
                    'status' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );

            DB::table('stores')->updateOrInsert(
                ['id' => $storeId],
                [
                    'name' => $vendorData['store_name'],
                    'phone' => $vendorData['phone'],
                    'email' => $vendorData['email'],
                    'address' => $vendorData['store_name'] . ' Demo Address',
                    'latitude' => '23.81695886557418',
                    'longitude' => '90.36934144046135',
                    'vendor_id' => $vendorId,
                    'module_id' => $moduleId,
                    'zone_id' => $zoneId,
                    'status' => 1,
                    'active' => 1,
                    'delivery' => 1,
                    'take_away' => 1,
                    'item_section' => 1,
                    'reviews_section' => 1,
                    'minimum_order' => 0.00,
                    'tax' => 0.00,
                    'delivery_time' => '30-40 min',
                    'veg' => 1,
                    'non_veg' => 1,
                    'store_business_model' => 'commission',
                    'slug' => $vendorData['store_slug'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );

            DB::table('translations')->updateOrInsert(
                ['translationable_type' => 'App\\Models\\Store', 'translationable_id' => $storeId, 'locale' => 'en', 'key' => 'name'],
                ['value' => $vendorData['store_name'], 'created_at' => now(), 'updated_at' => now()]
            );
            DB::table('translations')->updateOrInsert(
                ['translationable_type' => 'App\\Models\\Store', 'translationable_id' => $storeId, 'locale' => 'en', 'key' => 'address'],
                ['value' => $vendorData['store_name'] . ' Demo Address', 'created_at' => now(), 'updated_at' => now()]
            );
        }

        // Update module stores count
        $storesCount = DB::table('stores')->where('module_id', $moduleId)->count();
        DB::table('modules')->where('id', $moduleId)->update(['stores_count' => $storesCount]);
    }
}
