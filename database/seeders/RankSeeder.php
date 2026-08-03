<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (! Schema::hasTable('ranks')) {
            Schema::create('ranks', function ($table) {
                $table->id();
                $table->string('code')->unique();
                $table->string('name');
                $table->string('short_name');
                $table->unsignedInteger('level');
                $table->unsignedInteger('required_direct');
                $table->unsignedInteger('required_team');
                $table->timestamps();
            });
        }

        $now = Carbon::now();

        DB::table('ranks')->delete();

        DB::table('ranks')->insert([
            [
                'id' => 1,
                'code' => 'SO',
                'name' => 'Sales Officer',
                'short_name' => 'SO',
                'level' => 1,
                'required_direct' => 0,
                'required_team' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 2,
                'code' => 'ME',
                'name' => 'Marketing Executive',
                'short_name' => 'ME',
                'level' => 2,
                'required_direct' => 6,
                'required_team' => 6,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 3,
                'code' => 'AGM',
                'name' => 'Assistant General Manager',
                'short_name' => 'AGM',
                'level' => 3,
                'required_direct' => 6,
                'required_team' => 36,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 4,
                'code' => 'GM',
                'name' => 'General Manager',
                'short_name' => 'GM',
                'level' => 4,
                'required_direct' => 6,
                'required_team' => 216,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 5,
                'code' => 'ED',
                'name' => 'Executive Director',
                'short_name' => 'ED',
                'level' => 5,
                'required_direct' => 6,
                'required_team' => 1296,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
