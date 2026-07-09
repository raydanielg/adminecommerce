<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Review;

class ReviewFactory extends Factory
{
        /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Review::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $itemIds = \App\Models\Item::pluck('id')->toArray();
        $userIds = \App\Models\User::pluck('id')->toArray();
        $orderIds = \App\Models\Order::pluck('id')->toArray();

        return [
            'item_id' => !empty($itemIds) ? $this->faker->randomElement($itemIds) : 1,
            'user_id' => !empty($userIds) ? $this->faker->randomElement($userIds) : 1,
            'order_id' => !empty($orderIds) ? $this->faker->randomElement($orderIds) : 1,
            'item_campaign_id' => null,
            'comment' => $this->faker->sentence(),
            'rating' => $this->faker->numberBetween(1, 5),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
