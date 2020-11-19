<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->sentence($nbWords = 6, $variableNbWords = true);
        return [
            'name' => $name,
            'slug' => Str::slug($name, '-'),
            'organization_id' => $this->faker->numberBetween($min = 1, $max = 2),
            'contact_id' => $this->faker->numberBetween($min = 1, $max = 2),
            'category_id' => 1,
            'number_invoice' => $this->faker->numberBetween($min = 1000, $max = 9000),
            'price' => $this->faker->numberBetween($min = 10, $max = 2000),
            'int_number' => $this->faker->numberBetween($min = 10, $max = 100),
            'date_in' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
        ];
    }
}
