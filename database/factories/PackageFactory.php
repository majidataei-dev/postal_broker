<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Package;

class PackageFactory extends Factory
{
    protected $model = Package::class;

    public function definition()
    {
        return [
            'weight'       => $this->faker->randomFloat(2, 0.1, 50),
            'length'       => $this->faker->randomFloat(2, 1, 100),
            'width'        => $this->faker->randomFloat(2, 1, 100),
            'height'       => $this->faker->randomFloat(2, 1, 100),
            'package_type' => $this->faker->randomElement(['Carton', 'Envelope', 'Box']),
            'contents'     => $this->faker->sentence(),
        ];
    }
}
