<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpazilaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sqlPath = database_path('upazilas.sql');
        
        if (file_exists($sqlPath)) {
            $sql = file_get_contents($sqlPath);
            
            // Extract INSERT queries
            preg_match_all('/INSERT INTO `upazilas`[\s\S]+?;/i', $sql, $matches);
            
            foreach ($matches[0] as $query) {
                DB::unprepared($query);
            }
        }
    }
}
