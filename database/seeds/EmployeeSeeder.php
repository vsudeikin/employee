<?php

use Illuminate\Database\Seeder;
use App\Employee;
use App\Position;

class EmployeeSeeder extends Seeder
{
    /**
     * Array of different employee count +1 sorted by status.
     * Product Manager [1]
     * Project Manager [2]
     * Team lead       [3]
     * Designer        [4]
     * Front End       [5]
     * Back End        [6]
     *
     * To make 50k Seeds fill [1, 15, 29, 56, 16631, 16631, 16631 ]
     * And set $seedCount = 50000 
     * 
     * @var array
     */
    private static $employee = [1, 5, 10, 20, 40, 40, 40];
    /**
     * Employee count to seed
     * @var integer
     */
    private static $seedCount = 162;

    private static $position = 1;
    private static $salary = 10000;
    private static $pid = null;

     /**
     * Use faker Factory and generate dynamyc data.
     *
     * @return void
     */
    public function run()
    {
      factory(Employee::class, self::$seedCount)->make()
       ->each(function ($e) {
                self::calculate();
                $e->position_id = self::$position;
                $e->pid = self::$pid;
                $e->salary = self::$salary;
                $e->save();
       });
    }

    private function calculate()
    {
        for ($i = 2; $i <= 7; $i++) {
            if ( Position::find($i)->employee->count() == 0) {
                self::setData($i);
                break;
            } elseif (Position::find($i)->employee->count() <= self::$employee[$i - 1]) {
                $bosses = Position::find($i - 1)->employee->toArray();
                $countB = Position::find($i - 1)->employee->count();
                $index = $countB ? random_int(0, $countB) : 0;
                if($index) {
                    $index--;
                }
                self::setData($i, $bosses[$index]['id']);
                break;
            }
        }
    }

    /**
     * Calculate salary by rang
     * @param intager $position employee position
     */
    private function setSalary($position)
    {
        self::$salary = (int)(10000/$position);
    }

    /**
     * Set the position and parent data
     * @param integer $pos position
     * @param integer $pid calculated parent
     */
    private function setData($pos, $pid = null)
    {
        self::setSalary($pos);
        self::$position = $pos;
        if ($pos < 5){
            if ($pid) {
                self::$pid = $pid;
            } else {
                 self::$pid = Employee::latest()->first()->id;
            }
        } else {
            $bosses = Position::find(4)->employee->toArray();
            $countB = Position::find(4)->employee->count();
            $index = $countB ? random_int(0, $countB) : 0;
            if($index) {
                $index--;
            }
            self::$pid = $bosses[$index]['id'];
        }
    }

}
