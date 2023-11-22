<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Model\User;

class PermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modules = array(
            'Users',
            'Drivers',
            'Customer',
            'VehicleType',
            'VehicleMaker',
            'VehicleModels',
            'VehicleColors',
            'VehicleGroup',
            'VehicleInspection',
            'BookingQuotations',
            'PartsCategory',
            'Mechanics',
            'Vehicles',
            'Transactions',
            'Bookings',
            'Reports',
            'Fuel',
            'Vendors',
            'Parts',
            'WorkOrders',
            'Notes',
            'ServiceReminders',
            'ServiceItems',
            'Testimonials',
            'Team',
            'Settings',
            'Inquiries',
            'ProductYields'
        );
        foreach ($modules as $row) {

            Permission::firstOrCreate(['name' => $row . " add"]);
            Permission::firstOrCreate(['name' => $row . " edit"]);
            Permission::firstOrCreate(['name' => $row . " delete"]);
            Permission::firstOrCreate(['name' => $row . " list"]);
            Permission::firstOrCreate(['name' => $row . " import"]);
        }
        $all = Permission::all();
        $role = Role::firstOrCreate(['name' => 'Super Admin']);
        $role->givePermissionTo($all);
        $role = Role::firstOrCreate(['name' => 'Admin']);
        $role->givePermissionTo(['Bookings list','Bookings add','Bookings edit','Bookings delete','Drivers list','Drivers add','Drivers edit','Drivers delete','Customer list','Customer add','Customer edit','Customer delete']);
        $users = User::where('user_type', 'S')->get();
        foreach ($users as $user) {
            $u = User::find($user->id);
            $u->assignRole('Super Admin');
        }
        $drivers = User::where('user_type', 'D')->get();
        foreach ($drivers as $driver) {
            $d = User::find($driver->id);
            $d->givePermissionTo(['Notes add','Notes edit','Notes delete','Notes list','Drivers list','Fuel add','Fuel edit','Fuel delete','Fuel list','VehicleInspection add','Transactions list','Transactions add','Transactions edit','Transactions delete']);
        }
        $customers = User::where('user_type', 'C')->get();
        foreach ($customers as $customer) {
            $c = User::find($customer->id);
            $c->givePermissionTo(['Bookings add','Bookings edit','Bookings list','Bookings delete']);
        }
        $others = User::where('user_type', 'O')->get();
        foreach ($others as $other) {
            $o = User::find($other->id);
            $o->assignRole('Admin');
        }   
    }
}
