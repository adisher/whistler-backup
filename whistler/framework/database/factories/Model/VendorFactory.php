<?php

namespace Database\Factories\Model;

use App\Model\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

class VendorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vendor::class;
    
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
            'type' => $this->faker->randomElement(['Fuel', 'Machinaries', 'Parts']),
            'website' => "http://www.example.com",
            'note' => 'default vendor',
            'phone' => str_replace('+', 0, $this->faker->e164PhoneNumber),
            'address1' => $this->faker->address,
            'city' => $this->faker->city,
            'user_id' => 1,
        ];
    }
}
