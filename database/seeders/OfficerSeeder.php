<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class OfficerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (! Schema::hasTable('officers')) {
            Schema::create('officers', function ($table) {
                $table->id();
                $table->string('name');
                $table->string('rank_code')->nullable();
                $table->unsignedBigInteger('parent_id')->nullable();
                $table->unsignedInteger('position');
            });
        }

        DB::table('officers')->delete();

        DB::table('officers')->insert([
            [
                'id' => 1,
                'name' => 'Company',
                'rank_code' => null,
                'parent_id' => null,
                'position' => 1,
            ],
            [
                'id' => 2,
                'name' => 'Amir',
                'rank_code' => 'SO',
                'parent_id' => 1,
                'position' => 1,
            ],
            [
                'id' => 3,
                'name' => 'Sabir',
                'rank_code' => 'ME',
                'parent_id' => 2,
                'position' => 1,
            ],
            [
                'id' => 4,
                'name' => 'Hossain',
                'rank_code' => 'ED',
                'parent_id' => 3,
                'position' => 1,
            ],
            [
                'id' => 5,
                'name' => 'Jasim',
                'rank_code' => 'GM',
                'parent_id' => 4,
                'position' => 1,
            ],
            [
                'id' => 6,
                'name' => 'Kasem',
                'rank_code' => 'AGM',
                'parent_id' => 5,
                'position' => 1,
            ],
            [
                'id' => 7,
                'name' => 'Sadik',
                'rank_code' => 'ME',
                'parent_id' => 6,
                'position' => 1,
            ],
            [
                'id' => 8,
                'name' => 'Atik',
                'rank_code' => 'SO',
                'parent_id' => 7,
                'position' => 1,
            ],
            [
                'id' => 9,
                'name' => 'Nabir',
                'rank_code' => 'SO',
                'parent_id' => 8,
                'position' => 1,
            ],
            [
                'id' => 10,
                'name' => 'Kabir',
                'rank_code' => 'SO',
                'parent_id' => 9,
                'position' => 1,
            ],
            [
                'id' => 11,
                'name' => 'Jamal',
                'rank_code' => 'SO',
                'parent_id' => 10,
                'position' => 1,
            ],
            [
                'id' => 12,
                'name' => 'Kamal',
                'rank_code' => 'SO',
                'parent_id' => 11,
                'position' => 1,
            ],
        ]);
    }
}
