<?php
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'manage all submissions']);
        Permission::create(['name' => 'see all users']);
        Permission::create(['name' => 'make submissions']);

        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo('manage all submissions');
        $admin->givePermissionTo('see all users');

        $verifikator = Role::create(['name' => 'verifikator']);
        $verifikator->givePermissionTo('manage all submissions');

        $user = Role::create(['name' => 'user']);
        $user->givePermissionTo('make submissions');
    }
}
