<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $userIds = \App\Models\User::pluck('id')->toArray();
        $zoneIds = \App\Models\Zone::pluck('id')->toArray();
        $storeIds = \App\Models\Store::pluck('id')->toArray();
        $deliveryManIds = \App\Models\DeliveryMan::pluck('id')->toArray();

        $userId = !empty($userIds) ? $this->faker->randomElement($userIds) : 1;
        $zoneId = !empty($zoneIds) ? $this->faker->randomElement($zoneIds) : 1;
        $storeId = !empty($storeIds) ? $this->faker->randomElement($storeIds) : 1;
        $deliveryManId = !empty($deliveryManIds) ? $this->faker->randomElement($deliveryManIds) : null;
        $moduleId = \App\Models\Store::where('id', $storeId)->value('module_id') ?? 1;

        return [
            'user_id' => $userId,
            'zone_id' => $zoneId,
            'order_amount' => $this->faker->randomNumber(3),
            'order_status' => $this->faker->randomElement(['pending', 'delivered', 'failed', 'confirmed', 'processing']),
            'store_id' => $storeId,
            'store_discount_amount' => $this->faker->randomNumber(3),
            'module_id' => $moduleId,
            'delivery_man_id' => $deliveryManId,
            'payment_status' => $this->faker->randomElement(['paid', 'unpaid']),
            'payment_method' => $this->faker->randomElement(['cash_on_delivery', 'digital_payment']),
            'order_type' => 'delivery',
        ];
    }
}
