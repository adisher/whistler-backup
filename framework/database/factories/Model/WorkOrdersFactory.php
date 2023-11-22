<?php

namespace Database\Factories\Model;

use App\Model\WorkOrders;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkOrdersFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WorkOrders::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $vendor = \App\Model\Vendor::factory()->create();
        $mechanic = \App\Model\Mechanic::factory()->create();

        return [
            'vehicle_id' => $this->faker->randomElement([1, 2]),
            'vendor_id' => $vendor->id,
            'created_on' => date('Y-m-d'),
            'required_by' => date('Y-m-d', strtotime(' +5 day')),
            'status' => $this->faker->randomElement(["Pending", "Processing", "Completed"]),
            'description' => "Sample work order",
            'meter' => mt_rand(1000, 3000),
            'price' => $this->faker->randomElement([1000, 2000, 3000]),
            'note' => "sample work order",
            'mechanic_id' => $mechanic->id,
            'user_id' => 1,
        ];
    }
}
