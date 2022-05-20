<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$user = Admin::where('email', 'superadmin@gmail.com')->first();
        if(is_null($user))
        {
        $admin = new Admin;
        $admin->name = 'Super Admin';
        $admin->username = 'superadmin';
        $admin->email = 'superadmin@gmail.com';
        $admin->password = bcrypt('12345678');
        $admin->save();
        $admin->assignRole(['superadmin']);
        }
    }
}
