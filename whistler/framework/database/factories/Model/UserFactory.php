<?php

namespace Database\Factories\Model;

use App\Model\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

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
            'user_type' => "D",
            'api_token' => str_random(60),
            'password' => bcrypt('secret'),
            'remember_token' => str_random(10),
            'user_id' => 1,
        ];
    }
}
