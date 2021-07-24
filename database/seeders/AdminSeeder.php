<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create admin
        $role_admin = Role::create(['name' => 'Admin','guard_name'=>'admin']);

        $user_admin = Admin::create([
            'name' => 'admin',
            'email' => 'admin@abc.com',
            'password' => bcrypt('123456'),
            'remember_token' => Str::random(10),
        ]);

        $user_admin->assignRole([$role_admin->id]);

        //create Operation Manager
        $role_ope = Role::create(['name' => 'Operation Manager','guard_name'=>'admin']);

        $user_ope = Admin::create([
            'name' => 'operation',
            'email' => 'operation@abc.com',
            'password' => bcrypt('123456'),
            'remember_token' => Str::random(10),
        ]);

        $user_ope->assignRole([$role_ope->id]);

        //create Sales Manager
        $role_sales = Role::create(['name' => 'Sales Manager','guard_name'=>'admin']);

        $user_sales = Admin::create([
            'name' => 'sales',
            'email' => 'sales@abc.com',
            'password' => bcrypt('123456'),
            'remember_token' => Str::random(10),
        ]);

        $user_sales->assignRole([$role_sales->id]);
    }
}
