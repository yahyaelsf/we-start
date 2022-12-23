<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Villa>
 */
class VillaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->unique()->words(5, true),
            'price' => fake()->numberBetween(100,1000),
            'image' => fake()->imageUrl,
//            'image' =>  $this->faker->image(storage_path('app/public/images'),400, 300, null, false)
        ];
    }
}
