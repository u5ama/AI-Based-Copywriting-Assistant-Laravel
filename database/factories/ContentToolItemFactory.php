<?php

namespace Database\Factories;

use App\Models\ContentToolItem;
use Illuminate\Database\Eloquent\Factories\Factory;
use Laravel\Jetstream\Features;

class ContentToolItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ContentToolItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'input_title' => $this->faker->name,
            'input_info_text' => $this->faker->sentence,
            'input_info_placeholder' => $this->faker->sentence,
            'slug' => 'ascacs',
            'required' => 1,
            'input_limit' => '80',
            'input_type' => 'input',
            'status' => 'active',
        ];
    }
}
