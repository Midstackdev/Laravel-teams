<?php

use App\Models\Permission;
use App\Models\Role;
use App\Teams\Roles;
use Illuminate\Database\Seeder;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = Roles::$roles;

        foreach ($roles as $role => $data) {
        	$role = Role::firstOrCreate(['name' => $role]);

        	foreach ($data['permissions'] as $permission) {
        		Permission::firstOrCreate(['name' => $permission]);

        		$role->attachPermission($permission);
        	}
        }
    }
}
