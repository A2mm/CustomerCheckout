<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Item;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class ItemFactory extends Factory
{
    protected $model = Item::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
    
            'name'              => $this->faker->word(),
            'description'       => $this->faker->sentence(50),
            'price'             => rand(1000, 5000),

        ];
    }
}
