<?php

namespace Database\Factories;

use App\Models\News;
use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = News::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->realTextBetween(250, 400),
            'is_published' => $this->faker->boolean(70),
            'text' => $this->faker->realTextBetween(1000, 1500),
            'published_at' => $this->faker->dateTimeBetween('-2 months')
        ];
    }
}
