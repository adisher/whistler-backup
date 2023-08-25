<?php

namespace Database\Factories\Model;

use App\Model\Mechanic;
use Illuminate\Database\Eloquent\Factories\Factory;

class mechanicFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Mechanic::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'contact_number' => $this->faker->phoneNumber,
            'category' => "Electrical Engineering",
            'user_id' => 1,
        ];
    }
}
