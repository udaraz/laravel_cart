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

        $role = Role::create(['name' => 'Admin','guard_name'=>'admin']);

        $user = Admin::create([
            'name' => 'admin',
            'email' => 'admin@abc.com',
            'password' => bcrypt('123456'),
            'remember_token' => Str::random(10),
        ]);


        $user->assignRole([$role->id]);

        $role_list = [
            ['name' => 'Operation Manager','guard_name'=>'admin'],
            ['name' => 'Sales Manager','guard_name'=>'admin'],
        ];

        Role::insert($role_list);
    }
}
