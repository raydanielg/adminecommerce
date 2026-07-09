<?php

namespace Database\Factories;

use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Item::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $categoryIds = \App\Models\Category::where('status', 1)->pluck('id')->toArray();
        $storeIds = \App\Models\Store::where('status', 1)->pluck('id')->toArray();
        $moduleIds = \App\Models\Module::where('status', 1)->pluck('id')->toArray();

        $categoryId = !empty($categoryIds) ? $this->faker->randomElement($categoryIds) : 1;
        $storeId = !empty($storeIds) ? $this->faker->randomElement($storeIds) : 1;
        $moduleId = !empty($moduleIds) ? $this->faker->randomElement($moduleIds) : 1;
        $parentCategoryId = \App\Models\Category::where('id', $categoryId)->value('parent_id') ?: 0;

        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'image' => '2021-05-18-60a3e590d6811.png',
            'category_ids' => '[{"id":"' . $parentCategoryId . '","position":1},{"id":"' . $categoryId . '","position":2}]',
            'category_id' => $categoryId,
            'variations' => '[{"type":"Red-L","price":120},{"type":"Red-S","price":100},{"type":"White-L","price":120},{"type":"White-S","price":100}]',
            'add_ons' => '[]',
            'attributes' => '["2","1"]',
            'choice_options' => '[{"name":"choice_2","title":"Color","options":["Red","White"]},{"name":"choice_1","title":"Size","options":["L","S"]}]',
            'price' => $this->faker->randomNumber(2),
            'tax' => 0,
            'tax_type' => 'percent',
            'discount' => $this->faker->numberBetween(0, 100),
            'discount_type' => $this->faker->randomElement(['percent', 'amount']),
            'available_time_starts' => '10:00:00',
            'available_time_ends' => '22:00:00',
            'store_id' => $storeId,
            'module_id' => $moduleId,
            'stock' => $this->faker->numberBetween(10, 100),
            'status' => 1,
            'is_approved' => 1,
            'veg' => $this->faker->randomElement([0, 1]),
        ];
    }
}
