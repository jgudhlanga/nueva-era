<?php

use Illuminate\Database\Seeder;
use App\Models\General\Status;
use App\Models\General\Interest;

class InterestsTableSeeder extends Seeder
{

    public function run()
    {
        //Empty the table
        DB::table('interests')->delete();
        // Reset Auto Increment
        DB::statement('ALTER TABLE interests AUTO_INCREMENT = 0');
        $data = [
            1 => ['id' => 1, 'name' => 'Committee Worker', 'description' => 'Committee Worker', 'status_id' => Status::ACTIVE,'created_by' => 1],
            2 => ['id' => 2, 'name' => 'Drama', 'description' => 'Drama', 'status_id' => Status::ACTIVE,'created_by' => 1],
            3 => ['id' => 3, 'name' => 'Music', 'description' => 'Music', 'status_id' => Status::ACTIVE,'created_by' => 1],
            4 => ['id' => 4, 'name' => 'Sunday School', 'description' => 'Sunday School', 'status_id' => Status::ACTIVE,'created_by' => 1],
            5 => ['id' => 5, 'name' => 'Usher', 'description' => 'Usher', 'status_id' => Status::ACTIVE,'created_by' => 1],
            6 => ['id' => 6, 'name' => 'Visitations', 'description' => 'Visitations', 'status_id' => Status::ACTIVE,'created_by' => 1],
            7 => ['id' => 7, 'name' => 'Youth Worker', 'description' => 'Youth Worker', 'status_id' => Status::ACTIVE,'created_by' => 1],
            8 => ['id' => 8, 'name' => 'Other', 'description' => 'Other', 'status_id' => Status::ACTIVE,'created_by' => 1],
        ];

        foreach ($data as $row)
        {
            Interest::firstOrCreate($row);
        }
    }
}
