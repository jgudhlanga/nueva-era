<?php

use Illuminate\Database\Seeder;
use App\Models\General\Icon;
use App\Models\General\Status;
use Illuminate\Support\Facades\DB;

class IconsSeeder extends Seeder
{
	
	public function run()
	{
		//Empty the table
		DB::table('icons')->delete();
		// Reset Auto Increment
		DB::statement('ALTER TABLE icons AUTO_INCREMENT = 0');
		$data = [
			1 => ['id' => 1, 'name' => 'fa fa-home',  'status_id' => Status::ACTIVE,'created_by' => 1],
			2 => ['id' => 2, 'name' => 'fa fa-university', 'status_id' => Status::ACTIVE,'created_by' => 1],
			3 => ['id' => 3, 'name' => 'fa fa-group', 'status_id' => Status::ACTIVE,'created_by' => 1],
			4 => ['id' => 4, 'name' => 'fa fa-angle-right', 'status_id' => Status::ACTIVE,'created_by' => 1],
			5 => ['id' => 5, 'name' => 'fa fa-bed', 'status_id' => Status::ACTIVE,'created_by' => 1],
			6 => ['id' => 6, 'name' => 'fa fa-wrench', 'status_id' => Status::ACTIVE,'created_by' => 1],
			7 => ['id' => 7, 'name' => 'fa fa-cart-plus', 'status_id' => Status::ACTIVE,'created_by' => 1],
		];
		
		foreach ($data as $row)
		{
			Icon::firstOrCreate($row);
		}
	}
}