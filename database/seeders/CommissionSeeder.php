<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CommissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (! Schema::hasTable('commission_settings')) {
            Schema::create('commission_settings', function ($table) {
                $table->id();
                $table->string('rank_code');
                $table->unsignedInteger('generation');
                $table->unsignedInteger('commission');
                $table->string('bonus_type')->nullable();
                $table->timestamps();
            });
        }

        $now = Carbon::now();

        DB::table('commission_settings')->delete();

        DB::table('commission_settings')->insert([
            [
                'id' => 1,
                'rank_code' => 'ED',
                'generation' => 1,
                'commission' => 200,
                'bonus_type' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 2,
                'rank_code' => 'GM',
                'generation' => 1,
                'commission' => 200,
                'bonus_type' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 3,
                'rank_code' => 'GM',
                'generation' => 2,
                'commission' => 200,
                'bonus_type' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 4,
                'rank_code' => 'AGM',
                'generation' => 1,
                'commission' => 200,
                'bonus_type' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 5,
                'rank_code' => 'AGM',
                'generation' => 2,
                'commission' => 200,
                'bonus_type' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 6,
                'rank_code' => 'AGM',
                'generation' => 3,
                'commission' => 200,
                'bonus_type' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 7,
                'rank_code' => 'ME',
                'generation' => 1,
                'commission' => 300,
                'bonus_type' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 8,
                'rank_code' => 'ME',
                'generation' => 2,
                'commission' => 200,
                'bonus_type' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 9,
                'rank_code' => 'ME',
                'generation' => 3,
                'commission' => 200,
                'bonus_type' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 10,
                'rank_code' => 'ME',
                'generation' => 4,
                'commission' => 200,
                'bonus_type' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 11,
                'rank_code' => 'SO',
                'generation' => 1,
                'commission' => 1000,
                'bonus_type' => 'Joining Bonus = 500, Sales Bonus = 500',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 12,
                'rank_code' => 'SO',
                'generation' => 2,
                'commission' => 300,
                'bonus_type' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 13,
                'rank_code' => 'SO',
                'generation' => 3,
                'commission' => 200,
                'bonus_type' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 14,
                'rank_code' => 'SO',
                'generation' => 4,
                'commission' => 200,
                'bonus_type' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
