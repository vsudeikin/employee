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
    private static $employee = [1, 2, 4, 8, 16, 16, 16];

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
      factory(Employee::class, 99)->make()
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
