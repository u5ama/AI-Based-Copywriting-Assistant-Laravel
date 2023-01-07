<?php

namespace Database\Factories;

use App\Models\ContentTool;
use Illuminate\Database\Eloquent\Factories\Factory;
use Laravel\Jetstream\Features;

class ContentToolFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ContentTool::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name,
            'short_description' => $this->faker->unique()->safeEmail,
            'uri' => $this->faker->imageUrl(),
            'category' => $this->faker->name,
            'icon_path' => $this->faker->imageUrl(),
            'status' => 'active',
        ];
    }
}
