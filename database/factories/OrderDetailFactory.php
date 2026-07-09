<?php

namespace Database\Factories;

use App\Models\OrderDetail;
use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\CentralLogics\Helpers;

class OrderDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderDetail::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $itemIds = \App\Models\Item::pluck('id')->toArray();
        $orderIds = \App\Models\Order::pluck('id')->toArray();

        if (empty($itemIds) || empty($orderIds)) {
            return [];
        }

        $item_id = $this->faker->randomElement($itemIds);
        $order_id = $this->faker->randomElement($orderIds);
        $food = Item::find($item_id);

        if ($food) {
            $product = Helpers::product_data_formatting($food);
            return [
                'item_id' => $product['id'],
                'order_id' => $order_id,
                'item_campaign_id' => null,
                'item_details' => json_encode($product),
                'price' => $product['price'] ?? 0,
                'quantity' => $this->faker->numberBetween(1, 5),
                'tax_amount' => 0,
                'discount_on_item' => 0,
                'discount_type' => 'amount',
                'total_add_on_price' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        return [];
    }
}
