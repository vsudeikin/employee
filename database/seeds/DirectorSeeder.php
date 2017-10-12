<?php

use Illuminate\Database\Seeder;
use App\Employee;

class DirectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            Employee::create([
            'name' => 'John Smith',
            'start_work' => '1985-07-03',
            'salary' => 10000,
            'position_id' => 1,
            'pid' => 0,       
        ]);
    }
}
