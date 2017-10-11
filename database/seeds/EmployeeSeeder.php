<?php

use Illuminate\Database\Seeder;
use App\Employee;
use App\Position;

class EmployeeSeeder extends Seeder
{
    /**
     * Array of different employee count sorted by status
     * @var [type]
     */
    static protected $employee = [1, 2, 4, 8, 16, 16, 16];

    static protected $position = 1;
    static protected $salary = 10000;
    static protected $pid = null;

     /**
     * Use faker Factory and generate dynamyc data.
     *
     * @return void
     */
    public function run()
    {
      factory(Employee::class, 99)->make()
       ->each(function ($e) {
                EmployeeSeeder::calculate();
                $e->position_id = EmployeeSeeder::$position;
                $e->pid = EmployeeSeeder::$pid;
                $e->salary = EmployeeSeeder::$salary;
                $e->save();
       });
    }

    protected static function calculate()
    {
        for ($i = 2; $i <= 7; $i++) {
            if ( Position::find($i)->employee->count() == 0) {
                EmployeeSeeder::setData($i);
                break;
            } elseif (Position::find($i)->employee->count() <= EmployeeSeeder::$employee[$i - 1]) {
                $bosses = Position::find($i - 1)->employee->toArray();
                $countB = Position::find($i - 1)->employee->count();
                $index = $countB ? random_int(0, $countB) : 0;
                if($index) {
                    $index--;
                }
                EmployeeSeeder::setData($i, $bosses[$index]['id']);
                break;
            }
        }
    }

    /**
     * Calculate salary by rang
     * @param intager $position employee position
     */
    protected static function setSalary($position)
    {
        EmployeeSeeder::$salary = (int)(10000/$position);
    }

    /**
     * Set the position and parent data
     * @param integer $pos position
     * @param integer $pid calculated parent
     */
    protected static function setData($pos, $pid = null)
    {
        EmployeeSeeder::setSalary($pos);
        EmployeeSeeder::$position = $pos;
        if ($pos < 5){
            if ($pid) {
                EmployeeSeeder::$pid = $pid;
            } else {
                 EmployeeSeeder::$pid = Employee::latest()->first()->id;
            }
        } else {
            $bosses = Position::find(4)->employee->toArray();
            $countB = Position::find(4)->employee->count();
            $index = $countB ? random_int(0, $countB) : 0;
            if($index) {
                $index--;
            }
            EmployeeSeeder::$pid = $bosses[$index]['id'];
        }
    }

}
