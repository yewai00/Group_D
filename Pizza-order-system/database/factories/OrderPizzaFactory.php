<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderPizzaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_id'=>rand(1,5),
            'pizza_id'=>rand(1,4),
            'quantity'=>rand(1,3),
            'price'=>'200000'
        ];
    }
}
