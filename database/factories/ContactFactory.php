<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'organization_id' => $this->faker->numberBetween($min = 1, $max = 2),
            'name' => $this->name,
            'slug' => Str::slug($this->name, '-'),
            'email' => $this->faker->email,
            'street' => $this->faker->streetAddress,
            'city' => $this->faker->city,
            'phone' => $this->faker->phoneNumber,
            'ico' => $this->faker->randomNumber($nbDigits = 8, $strict = false),
            'psc' => $this->faker->randomNumber($nbDigits = 5, $strict = false),
        ];
    }
}



