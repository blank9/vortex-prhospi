<?php

use Illuminate\Database\Seeder;

class HostelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hostels = [
        	['hostel_name'=> 'Zircon A', 'sex'=> 'male', 'floor'=> 1, 'total'=> 25, 'available'=> 25],
            ['hostel_name'=> 'Zircon A', 'sex'=> 'male', 'floor'=> 2, 'total'=> 25, 'available'=> 25],
            ['hostel_name'=> 'Zircon B', 'sex'=> 'male', 'floor'=> 1, 'total'=> 25, 'available'=> 25],
            ['hostel_name'=> 'Zircon B', 'sex'=> 'male', 'floor'=> 2, 'total'=> 25, 'available'=> 25],
            ['hostel_name'=> 'Zircon C', 'sex'=> 'male', 'floor'=> 1, 'total'=> 25, 'available'=> 25],
            ['hostel_name'=> 'Zircon C', 'sex'=> 'male', 'floor'=> 2, 'total'=> 25, 'available'=> 25],
            ['hostel_name'=> 'Aquamarine A', 'sex'=> 'male', 'floor'=> 1, 'total'=> 25, 'available'=> 25],
            ['hostel_name'=> 'Aquamarine B', 'sex'=> 'male', 'floor'=> 2, 'total'=> 25, 'available'=> 25],
            ['hostel_name'=> 'Opal CR1', 'sex'=> 'female', 'floor'=> 1, 'total'=> 25, 'available'=> 25],
            ['hostel_name'=> 'Opal CR2', 'sex'=> 'female', 'floor'=> 2, 'total'=> 25, 'available'=> 25],
            ['hostel_name'=> 'Opal CR3', 'sex'=> 'female', 'floor'=> 1, 'total'=> 25, 'available'=> 25],
            ['hostel_name'=> 'Opal CR4', 'sex'=> 'female', 'floor'=> 2, 'total'=> 25, 'available'=> 25],
            ['hostel_name'=> 'Opal CR5', 'sex'=> 'female', 'floor'=> 1, 'total'=> 25, 'available'=> 25]
        ];

        DB::table('hostels')->insert($hostels);
    }
}
