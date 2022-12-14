<?php

namespace Database\Factories;

use App\Models\Graph;
use Illuminate\Database\Eloquent\Factories\Factory;

class GraphFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Graph::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'Graph '. $this->faker->unique()->word(8),
            'description' =>  $this->faker->sentence(5)
        ];
    }
}
