<?php

use Illuminate\Database\Seeder;
use App\Models\General\Language;
use Illuminate\Support\Facades\DB;

class LanguagesTableSeeder extends Seeder
{


    public function run()
    {
        //Empty the table
        DB::table('languages')->delete();
        // Reset Auto Increment
        DB::statement('ALTER TABLE languages AUTO_INCREMENT = 0');
        $data = [
            1 => ['id' => 1, 'name' => 'English', 'description' => 'Global Default Language', 'created_by' => 1],
        ];

        foreach ($data as $row)
        {
            Language::firstOrCreate($row);
        }
    }
}
