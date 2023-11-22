<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\ShiftDetails;
use App\Model\WorkOrders;
use Carbon\Carbon;

class DashboardController extends Controller
{

    public function __construct()
    {
        // $this->middleware(['role:Admin']);
        $this->middleware('permission:Reports add', ['only' => ['create']]);
        $this->middleware('permission:Reports edit', ['only' => ['edit']]);
        $this->middleware('permission:Reports delete', ['only' => ['bulk_delete', 'destroy']]);
        $this->middleware('permission:Reports list');
    }

    public function production()
    {
        // Initialize empty arrays for chart data
        $dailyProduction = [];
        $weeklyProduction = [];
        $yearlyProduction = [];
        $shiftProduction = [];

        // Fetch data from ShiftDetails model
        $shiftDetails = ShiftDetails::with('shift')->get();

        // Loop through each record to populate the chart data
        foreach ($shiftDetails as $shiftDetail) {
            $date = new Carbon($shiftDetail->date); // Assuming the date field is in 'Y-m-d' format
            $shiftName = $shiftDetail->shift->shift_name;

            // Daily Production (in grams)
            if (!isset($dailyProduction[$date->toDateString()])) {
                $dailyProduction[$date->toDateString()] = 0;
            }
            $dailyProduction[$date->toDateString()] += $shiftDetail->daily_quantity_grams;

            // Weekly Production (in grams)
            $weekNumber = $date->weekOfYear;
            $year = $date->year;
            $uniqueWeekKey = "$year-$weekNumber";

            if (!isset($weeklyProduction[$uniqueWeekKey])) {
                $weeklyProduction[$uniqueWeekKey] = 0;
            }
            $weeklyProduction[$uniqueWeekKey] += $shiftDetail->daily_quantity_grams;

            // Yearly Production (in grams)
            $year = $date->year;
            if (!isset($yearlyProduction[$year])) {
                $yearlyProduction[$year] = 0;
            }
            $yearlyProduction[$year] += $shiftDetail->daily_quantity_grams;

            // Initialize the array for this date if not already set
            if (!isset($shiftProduction[$date->toDateString()])) {
                $shiftProduction[$date->toDateString()] = [
                    'morning' => 0,
                    'evening' => 0,
                ];
            }

            // Add the production quantity to the corresponding shift
            if ($shiftName == 'morning') {
                $shiftProduction[$date->toDateString()]['morning'] += $shiftDetail->daily_quantity_grams;
            } elseif ($shiftName == 'evening') {
                $shiftProduction[$date->toDateString()]['evening'] += $shiftDetail->daily_quantity_grams;
            }
        }

        // Prepare the final data array
        $data = [
            'daily' => $dailyProduction,
            'weekly' => $weeklyProduction,
            'yearly' => $yearlyProduction,
            'shifts' => $shiftProduction,
        ];

        return response()->json($data);
    }

    public function vehicleWorkHours()
    {
        // Initialize empty arrays for chart data
        $shiftWorkHours = [];
        $dailyWorkHours = [];
        $weeklyWorkHours = [];
        $yearlyWorkHours = [];

        // Fetch work order data with shift relation
        $workOrders = WorkOrders::with('shift', 'vehicle')->get();
        // dd($workOrders);

        foreach ($workOrders as $workOrder) {
            $date = new Carbon($workOrder->date);
            $vehicleId = $workOrder->vehicle_id; // Get the vehicle ID
            $make = $workOrder->vehicle->vehicleData->make;
            $model = $workOrder->vehicle->vehicleData->model;
            $plateNumber = $workOrder->vehicle->license_plate;
            $vehicleName = $make . "-" . $model . "-" . $plateNumber;
            // dd($vehicleName);

            $shiftName = $workOrder->shift->shift_name;
            $workHoursString = $workOrder->work_hours;
            // dd($workHoursString);

            // Convert work hours string to total hours
            $parts = explode(':', $workHoursString);
            $minutes = $parts[0] * 60 + $parts[1];

            // Key format: 'vehicleId-date'
            $key = $vehicleName . '-' . $date->toDateString();
            // dd($key);

            // Initialize the array for this vehicle and date if not already set
            if (!isset($shiftWorkHours[$key])) {
                $shiftWorkHours[$key] = [
                    'morning' => '00:00',
                    'evening' => '00:00',
                    // ... other shifts if any
                ];
            }

            // Aggregate Daily Work Hours
            $dateKey = $date->toDateString();
            if (!isset($dailyWorkHours[$dateKey])) {
                $dailyWorkHours[$dateKey] = '00:00';
            }
            $dailyWorkHours[$dateKey] = $this->addTimes($dailyWorkHours[$dateKey], $workHoursString);

            // Aggregate Weekly Work Hours
            $weekNumber = $date->weekOfYear;
            $year = $date->year;
            $weeklyKey = "$year-$weekNumber";
            if (!isset($weeklyWorkHours[$weeklyKey])) {
                $weeklyWorkHours[$weeklyKey] = '00:00';
            }
            $weeklyWorkHours[$weeklyKey] = $this->addTimes($weeklyWorkHours[$weeklyKey], $workHoursString);

            // Aggregate Yearly Work Hours
            if (!isset($yearlyWorkHours[$year])) {
                $yearlyWorkHours[$year] = '00:00';
            }
            $yearlyWorkHours[$year] = $this->addTimes($yearlyWorkHours[$year], $workHoursString);

            // Aggregate shift-wise work hours
            if ($shiftName == 'morning') {
                $shiftWorkHours[$key]['morning'] = $this->addTimes($shiftWorkHours[$key]['morning'], $workHoursString);
            } elseif ($shiftName == 'evening') {
                $shiftWorkHours[$key]['evening'] = $this->addTimes($shiftWorkHours[$key]['evening'], $workHoursString);
            }

            // ... handle other shifts if any
        }

        // Prepare the final data array
        $data = [
            'shifts' => $shiftWorkHours,
            'daily' => $dailyWorkHours,
            'weekly' => $weeklyWorkHours,
            'yearly' => $yearlyWorkHours,
        ];

        return response()->json($data);
    }

    // Helper function to add two times in "HH:MM" format
    private function addTimes($time1, $time2)
    {
        $times = [$time1, $time2];
        $minutes = 0;

        foreach ($times as $time) {
            list($hour, $minute) = explode(':', $time);
            $minutes += $hour * 60;
            $minutes += $minute;
        }

        $hours = floor($minutes / 60);
        $minutes -= $hours * 60;

        // Return the formatted time in "HH:MM" format
        return sprintf('%02d:%02d', $hours, $minutes);
    }

}
