<?php

namespace Database\Factories;

use App\Models\Center;
use App\Models\Region;
use Illuminate\Database\Eloquent\Factories\Factory;

class CenterFactory extends Factory
{
    protected $model = Center::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company() . ' Center',
            'code' => $this->faker->unique()->bothify('CTR-###'),
            'region_id' => Region::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}