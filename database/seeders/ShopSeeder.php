<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds for a complete Shop module demo.
     *
     * @return void
     */
    public function run()
    {
        // Use a fixed module ID far from defaults to avoid collisions
        $moduleId = 100;
        $vendorId = 100;
        $storeId = 100;
        $parentCategoryId = 100;
        $subCategoryId = 101;
        $itemIds = [100, 101, 102, 103, 104];

        // --- Module ---
        DB::table('modules')->updateOrInsert(
            ['id' => $moduleId],
            [
                'module_name' => 'Shop',
                'module_type' => 'shop',
                'thumbnail' => null,
                'status' => 1,
                'stores_count' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'icon' => null,
                'theme_id' => 1,
                'description' => '<p>Shop module for general ecommerce products.</p>',
                'all_zone_service' => 0,
                'slug' => 'shop',
            ]
        );

        DB::table('translations')->updateOrInsert(
            ['translationable_type' => 'App\\Models\\Module', 'translationable_id' => $moduleId, 'locale' => 'en', 'key' => 'module_name'],
            ['value' => 'Shop', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('translations')->updateOrInsert(
            ['translationable_type' => 'App\\Models\\Module', 'translationable_id' => $moduleId, 'locale' => 'en', 'key' => 'description'],
            ['value' => '<p>Shop module for general ecommerce products.</p>', 'created_at' => now(), 'updated_at' => now()]
        );

        // --- Zone ---
        $zone = DB::table('zones')->first();
        if (!$zone) {
            $zoneId = DB::table('zones')->insertGetId([
                'name' => 'Demo Zone',
                'coordinates' => DB::raw("ST_GeomFromText('POLYGON((0 0, 10 0, 10 10, 0 10, 0 0))')"),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'store_wise_topic' => 'zone_1_store',
                'customer_wise_topic' => 'zone_1_customer',
                'deliveryman_wise_topic' => 'zone_1_delivery_man',
                'cash_on_delivery' => 1,
                'digital_payment' => 1,
                'increased_delivery_fee' => 0.00,
                'increased_delivery_fee_status' => 0,
                'offline_payment' => 0,
                'is_default' => 1,
            ]);
            $zone = (object)['id' => $zoneId];
        }
        $zoneId = $zone->id;

        DB::table('translations')->updateOrInsert(
            ['translationable_type' => 'App\\Models\\Zone', 'translationable_id' => $zoneId, 'locale' => 'en', 'key' => 'name'],
            ['value' => $zone->name ?? 'Demo Zone', 'created_at' => now(), 'updated_at' => now()]
        );

        // --- Vendor ---
        DB::table('vendors')->updateOrInsert(
            ['id' => $vendorId],
            [
                'f_name' => 'Shop',
                'l_name' => 'Vendor',
                'phone' => '+101522222222',
                'email' => 'shop.vendor@demo.com',
                'password' => bcrypt(12345678),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'image' => null,
            ]
        );

        // --- Store ---
        DB::table('stores')->updateOrInsert(
            ['id' => $storeId],
            [
                'name' => 'Shop Store',
                'phone' => '+101522222222',
                'email' => 'shop.store@demo.com',
                'logo' => null,
                'latitude' => '23.81695886557418',
                'longitude' => '90.36934144046135',
                'address' => 'Shop Demo Address',
                'minimum_order' => 0.00,
                'status' => 1,
                'vendor_id' => $vendorId,
                'created_at' => now(),
                'updated_at' => now(),
                'delivery' => 1,
                'take_away' => 1,
                'item_section' => 1,
                'tax' => 0.00,
                'zone_id' => $zoneId,
                'reviews_section' => 1,
                'active' => 1,
                'delivery_time' => '30-40 min',
                'veg' => 1,
                'non_veg' => 1,
                'module_id' => $moduleId,
                'store_business_model' => 'commission',
                'slug' => 'shop-store',
            ]
        );

        DB::table('translations')->updateOrInsert(
            ['translationable_type' => 'App\\Models\\Store', 'translationable_id' => $storeId, 'locale' => 'en', 'key' => 'name'],
            ['value' => 'Shop Store', 'created_at' => now(), 'updated_at' => now()]
        );
        DB::table('translations')->updateOrInsert(
            ['translationable_type' => 'App\\Models\\Store', 'translationable_id' => $storeId, 'locale' => 'en', 'key' => 'address'],
            ['value' => 'Shop Demo Address', 'created_at' => now(), 'updated_at' => now()]
        );

        // --- Categories ---
        DB::table('categories')->updateOrInsert(
            ['id' => $parentCategoryId],
            [
                'name' => 'Shop Category',
                'image' => 'def.png',
                'parent_id' => 0,
                'position' => 0,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'priority' => 0,
                'module_id' => $moduleId,
                'slug' => 'shop-category',
                'featured' => 1,
            ]
        );

        DB::table('translations')->updateOrInsert(
            ['translationable_type' => 'App\\Models\\Category', 'translationable_id' => $parentCategoryId, 'locale' => 'en', 'key' => 'name'],
            ['value' => 'Shop Category', 'created_at' => now(), 'updated_at' => now()]
        );

        DB::table('categories')->updateOrInsert(
            ['id' => $subCategoryId],
            [
                'name' => 'Shop Sub Category',
                'image' => 'def.png',
                'parent_id' => $parentCategoryId,
                'position' => 1,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'priority' => 0,
                'module_id' => $moduleId,
                'slug' => 'shop-sub-category',
                'featured' => 0,
            ]
        );

        DB::table('translations')->updateOrInsert(
            ['translationable_type' => 'App\\Models\\Category', 'translationable_id' => $subCategoryId, 'locale' => 'en', 'key' => 'name'],
            ['value' => 'Shop Sub Category', 'created_at' => now(), 'updated_at' => now()]
        );

        // --- Products ---
        $productCount = 30;
        for ($i = 0; $i < $productCount; $i++) {
            $productId = $itemIds[0] + $i;
            $productName = 'Shop Product ' . ($i + 1);
            $productPrice = 50.00 + ($i * 25.00);

            DB::table('items')->updateOrInsert(
                ['id' => $productId],
                [
                    'name' => $productName,
                    'description' => $productName . ' Description',
                    'image' => '2021-05-18-60a3e590d6811.png',
                    'category_id' => $subCategoryId,
                    'category_ids' => '[{"id":"' . $parentCategoryId . '","position":1},{"id":"' . $subCategoryId . '","position":2}]',
                    'variations' => '[]',
                    'add_ons' => '[]',
                    'attributes' => '[]',
                    'choice_options' => '[]',
                    'price' => $productPrice,
                    'tax' => 0.00,
                    'tax_type' => 'percent',
                    'discount' => 0.00,
                    'discount_type' => 'percent',
                    'available_time_starts' => '00:00:00',
                    'available_time_ends' => '23:59:59',
                    'veg' => 0,
                    'status' => 1,
                    'store_id' => $storeId,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'module_id' => $moduleId,
                    'stock' => 100,
                    'slug' => Str::slug($productName),
                    'recommended' => 0,
                    'organic' => 0,
                    'is_approved' => 1,
                    'is_halal' => 0,
                ]
            );

            DB::table('translations')->updateOrInsert(
                ['translationable_type' => 'App\\Models\\Item', 'translationable_id' => $productId, 'locale' => 'en', 'key' => 'name'],
                ['value' => $productName, 'created_at' => now(), 'updated_at' => now()]
            );
            DB::table('translations')->updateOrInsert(
                ['translationable_type' => 'App\\Models\\Item', 'translationable_id' => $productId, 'locale' => 'en', 'key' => 'description'],
                ['value' => $productName . ' Description', 'created_at' => now(), 'updated_at' => now()]
            );
        }
    }
}
