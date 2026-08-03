<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $divisions = array(
            array('id' => '1','name' => 'Admin','email' => 'admin@gmail.com','password' => bcrypt('12345678')),
        );

        DB::table('users')->insert($divisions);
    }
}
