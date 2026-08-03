<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        app()['cache']->forget('spatie.permission.cache');

        DB::table('model_has_permissions')->delete();
        DB::table('permissions')->delete();

        $permissions = [
            ['name' => 'Dashboard',                  'parent' => 'Dashboard'],
            ['name' => 'Access control menu',        'parent' => 'Dashboard'],
            ['name' => 'Activity log menu',          'parent' => 'Dashboard'],

            ['name' => 'User list',                  'parent' => 'User'],
            ['name' => 'User create',                'parent' => 'User'],
            ['name' => 'User show',                  'parent' => 'User'],
            ['name' => 'User edit',                  'parent' => 'User'],
            ['name' => 'User delete',                'parent' => 'User'],
            ['name' => 'User deleted button',        'parent' => 'User'],
            ['name' => 'User restore',               'parent' => 'User'],
            ['name' => 'User permanent delete',      'parent' => 'User'],

            ['name' => 'Role list',                  'parent' => 'Role'],
            ['name' => 'Role create',                'parent' => 'Role'],
            ['name' => 'Role show',                  'parent' => 'Role'],
            ['name' => 'Role edit',                  'parent' => 'Role'],
            ['name' => 'Role delete',                'parent' => 'Role'],

            ['name' => 'Permission list',            'parent' => 'Permission'],
            ['name' => 'Permission create',          'parent' => 'Permission'],
            ['name' => 'Permission show',            'parent' => 'Permission'],
            ['name' => 'Permission edit',            'parent' => 'Permission'],
            ['name' => 'Permission delete',          'parent' => 'Permission'],

            ['name' => 'Login activity list',         'parent' => 'Login activity'],
            ['name' => 'Login activity show',         'parent' => 'Login activity'],
            ['name' => 'Login activity clear button', 'parent' => 'Login activity'],

            ['name' => 'Admin activity list',             'parent' => 'Admin activity'],
            ['name' => 'Admin activity show',             'parent' => 'Admin activity'],
            ['name' => 'Admin activity clear button',     'parent' => 'Admin activity'],

            ['name' => 'Geographic menu',                 'parent' => 'Geographic'],
            ['name' => 'Division list',                   'parent' => 'Division'],
            ['name' => 'Division create',                 'parent' => 'Division'],
            ['name' => 'Division edit',                   'parent' => 'Division'],
            ['name' => 'Division delete',                 'parent' => 'Division'],

            ['name' => 'District list',                   'parent' => 'District'],
            ['name' => 'District create',                 'parent' => 'District'],
            ['name' => 'District edit',                   'parent' => 'District'],
            ['name' => 'District delete',                 'parent' => 'District'],

            ['name' => 'Upazila list',                    'parent' => 'Upazila'],
            ['name' => 'Upazila create',                  'parent' => 'Upazila'],
            ['name' => 'Upazila edit',                    'parent' => 'Upazila'],
            ['name' => 'Upazila delete',                  'parent' => 'Upazila'],

            ['name' => 'Union list',                      'parent' => 'Union'],
            ['name' => 'Union create',                    'parent' => 'Union'],
            ['name' => 'Union edit',                      'parent' => 'Union'],
            ['name' => 'Union delete',                    'parent' => 'Union'],
        ];

        $now = now();
        foreach ($permissions as $perm) {
            DB::table('permissions')->insert([
                'name'       => $perm['name'],
                'parent'     => $perm['parent'],
                'guard_name' => 'web',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
