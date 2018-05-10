<?php

use Illuminate\Database\Seeder;

class ManagersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$mgrs = [
    		['id'=> 123456789, 'name'=> 'test', 'pwd'=>'test']
    	];
        DB::table('managers')->insert($mgrs);
    }
}
