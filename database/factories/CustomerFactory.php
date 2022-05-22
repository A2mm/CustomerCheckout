<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
    
            'email'            => $this->faker->unique()->safeEmail(),
            'first_name'       => $this->faker->name(),
            'last_name'        => $this->faker->name(),
            'store_credit'     => 10000,

        ];
    }
}
