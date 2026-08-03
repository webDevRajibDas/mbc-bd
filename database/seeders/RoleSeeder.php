<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $officerRole = Role::firstOrCreate([
            'name' => 'Officer',
            'guard_name' => 'web',
        ]);

        $officerEmail = env('OFFICER_EMAIL');

        if ($officerEmail) {
            $user = User::where('email', $officerEmail)->first();

            if ($user && ! $user->hasRole($officerRole)) {
                $user->assignRole($officerRole);
            }
        }
    }
}
