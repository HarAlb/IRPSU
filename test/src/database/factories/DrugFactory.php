<?php

namespace Database\Factories;

use App\Models\Drug;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Class DrugFactory
 * @package Database\Factories
 */
class DrugFactory extends Factory
{
    protected $model = Drug::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name
        ];
    }
}
