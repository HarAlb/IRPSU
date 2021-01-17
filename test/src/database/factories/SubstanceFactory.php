<?php

namespace Database\Factories;

use App\Models\Substance;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Class SubstanceFactory
 * @package Database\Factories
 */
class SubstanceFactory extends Factory
{
    protected $model = Substance::class;

    /**
     * @return array
     */
    public function definition()
    {
        return [
            'name'    => $this->faker->name,
            'visible' => true
        ];
    }
}
