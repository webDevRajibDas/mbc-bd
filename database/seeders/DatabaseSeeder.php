<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        app()['cache']->forget('spatie.permission.cache');

        $this->call(PermissionsTableSeeder::class);
        $this->call(SidebarPermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(DivisionSeeder::class);
        $this->call(DistrictSeeder::class);
        $this->call(UpazilaSeeder::class);
        $this->call(UnionSeeder::class);
        $this->call(RankSeeder::class);
        $this->call(CommissionSeeder::class);
        $this->call(OfficerSeeder::class);

        $superAdmin = Role::firstOrCreate(['name' => 'Super Admin', 'guard_name' => 'web']);
        $masterAdmin = Role::firstOrCreate(['name' => 'Master Admin', 'guard_name' => 'web']);
        $allPermissions = Permission::all();
        $superAdmin->syncPermissions($allPermissions);
        $masterAdmin->syncPermissions($allPermissions);

        DB::table('users')->insertOrIgnore([
            'name'              => 'Super Admin',
            'email'             => 'admin@mbcbd.com',
            'password'          => bcrypt('password'),
            'status'            => 'active',
            'email_verified_at' => now(),
            'created_at'        => now(),
            'updated_at'        => now(),
        ]);

        $user = \App\Models\User::where('email', 'admin@mbcbd.com')->first();
        if ($user) {
            $user->assignRole('Super Admin');
        }
    }
}
