<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'full_name' => $this->faker->name(),
            'mobile' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'zip_code' => $this->faker->postcode(),
        ];
    }
}
