<?php

use Illuminate\Database\Seeder;
use App\Position;

class PositionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('positions')->insert([
            ['position' => 'director'],
            ['position' => 'product manager'],
            ['position' => 'project manager'],
            ['position' => 'team lead'],
            ['position' => 'designer'],
            ['position' => 'front-end developer'],
            ['position' => 'back-end developer']        
        ]);
    }
}
