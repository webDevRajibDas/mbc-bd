<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SidebarPermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()['cache']->forget('spatie.permission.cache');

        \DB::table('permissions')->insertOrIgnore([
            ['id' => 34, 'name' => 'Access control menu',    'parent' => 'Dashboard',    'guard_name' => 'web'],
            ['id' => 35, 'name' => 'Activity log menu',      'parent' => 'Dashboard',    'guard_name' => 'web'],
        ]);
    }
}
