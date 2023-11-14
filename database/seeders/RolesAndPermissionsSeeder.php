<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('roles')->truncate();
        DB::table('role_has_permissions')->truncate();
        DB::table('permissions')->truncate();
        DB::table('model_has_roles')->truncate();
        DB::table('model_has_permissions')->truncate();

        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'user.list']);
        Permission::create(['name' => 'user.detail']);
        Permission::create(['name' => 'user.create']);
        Permission::create(['name' => 'user.update']);
        Permission::create(['name' => 'user.update_status']);

        Permission::create(['name' => 'role.list']);
        Permission::create(['name' => 'role.detail']);
        Permission::create(['name' => 'role.create']);
        Permission::create(['name' => 'role.update']);

        // create roles and assign created permissions

        // this can be done as separate statements
        // $role = Role::create(['name' => 'administrator']);
        // $role->givePermissionTo('edit articles');

        // or may be done by chaining
        // $role = Role::create(['name' => 'moderator'])
        //     ->givePermissionTo(['publish articles', 'unpublish articles']);

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
