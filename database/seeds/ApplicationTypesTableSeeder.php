<?php

use Illuminate\Database\Seeder;
use App\Models\General\Status;
use App\Models\General\ApplicationType;

class ApplicationTypesTableSeeder extends Seeder
{
    public function run()
    {
        //Empty the table
        DB::table('application_types')->delete();
        // Reset Auto Increment
        DB::statement('ALTER TABLE application_types AUTO_INCREMENT = 0');
        $data = [
            1 => ['id' => 1, 'name' => 'New Application', 'description' => 'New Application', 'status_id' => Status::ACTIVE,'created_by' => 1],
            2 => ['id' => 2, 'name' => 'Transfer In', 'description' => 'Transfer in from another church', 'status_id' => Status::ACTIVE,'created_by' => 1],
            3 => ['id' => 3, 'name' => 'Reinstatement', 'description' => 'Reinstatement', 'status_id' => Status::ACTIVE,'created_by' => 1],
        ];

        foreach ($data as $row)
        {
            ApplicationType::firstOrCreate($row);
        }
    }
}
