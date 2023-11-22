<?php

namespace Database\Factories\Model;

use App\Model\Bookings;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Bookings::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $date = $this->faker->dateTimeThisMonth($max = 'now', $timezone = date_default_timezone_get());
        $drop = $this->faker->dateTimeInInterval($startDate = $date, $interval = '+ 2 days', $timezone = date_default_timezone_get());

        return [
            'customer_id' => $this->faker->randomElement([4, 5]),
            'user_id' => 1,
            'vehicle_id' => 1,
            'driver_id' => $this->faker->randomElement([6, 7]),
            'pickup' => $date,
            'dropoff' => $drop, //add 2 days
            'duration' => '2880',
            'pickup_addr' => $this->faker->address,
            'dest_addr' => $this->faker->address,
            'note' => 'sample note',
            'travellers' =>$this->faker->randomElement([1, 2, 3, 4]),
            'status' => 0,

        ];
    }
}
