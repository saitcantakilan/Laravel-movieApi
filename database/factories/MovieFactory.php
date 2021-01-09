<?php

namespace Database\Factories;

use App\Models\Movie;
use App\Models\Director;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MovieFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Movie::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'director_id' => Director::factory(),
            'title' => $this->faker->title,
            'category' => $this->faker->sentence(1),
            'country' => $this->faker->sentence(1),
            'imdb_score' => rand(1,10),
            'year' => rand(1990,2020),
        ];
    }
}
