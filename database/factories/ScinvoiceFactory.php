<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ScinvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'prod_id'=> fake()->randomNumber,
            'Uom_id'=> fake()->randomNumber,
            'Quantity'=> fake()->randomNumber,
            'Total_value'=> fake()->randomNumber,
            'incentive_value'=> fake()->randomNumber,
            'net_value'=> fake()->randomNumber,
            'loading_number'=> fake()->randomNumber,
            'salescall_details_id'=> fake()->randomNumber,
        ];
    }

}
