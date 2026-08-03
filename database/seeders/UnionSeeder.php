<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sqlPath = database_path('unions.sql');
        
        if (file_exists($sqlPath)) {
            $sql = file_get_contents($sqlPath);
            
            // Replace the misspelled column upazilla_id with upazila_id from SQL dump
            $sql = str_replace('`upazilla_id`', '`upazila_id`', $sql);
            
            // Extract INSERT queries
            preg_match_all('/INSERT INTO `unions`[\s\S]+?;/i', $sql, $matches);
            
            foreach ($matches[0] as $query) {
                DB::unprepared($query);
            }
        }
    }
}
