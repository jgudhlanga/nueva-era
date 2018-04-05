<?php

use Illuminate\Database\Seeder;
use App\Models\General\Status;
use Illuminate\Support\Facades\DB;

class StatusesSeeder extends Seeder
{
    public function run()
    {
	    //Empty the table
	    DB::table('statuses')->delete();
	    // Reset Auto Increment
	    DB::statement('ALTER TABLE statuses AUTO_INCREMENT = 0');
	    $data = [
		    1 => ['id' => 1, 'name' => 'Active', 'description' => 'Model Is Active', 'created_by' => 1],
		    2 => ['id' => 2, 'name' => 'Inactive', 'description' => 'Model Is Active', 'created_by' => 1],
	    ];
	
	    foreach ($data as $row)
	    {
		    Status::firstOrCreate($row);
	    }
    }
}
