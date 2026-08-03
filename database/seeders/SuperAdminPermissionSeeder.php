<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SuperAdminPermissionSeeder extends Seeder
{
    public function run()
    {
        app()['cache']->forget('spatie.permission.cache');

        $superAdminRole = \DB::table('roles')->where('name', 'Super Admin')->first();

        if ($superAdminRole) {
            // Remove existing permission assignments for Super Admin
            \DB::table('role_has_permissions')->where('role_id', $superAdminRole->id)->delete();

            // Assign all current permissions to Super Admin
            $permissions = \DB::table('permissions')->get();
            foreach ($permissions as $permission) {
                \DB::table('role_has_permissions')->insert([
                    'permission_id' => $permission->id,
                    'role_id' => $superAdminRole->id,
                ]);
            }

            $this->command->info('Super Admin role synced with all ' . $permissions->count() . ' permissions.');
        } else {
            $this->command->warn('Super Admin role not found. Skipping permission sync.');
        }
    }
}
