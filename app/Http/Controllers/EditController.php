<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;

class EditController extends Controller
{

    /**
     * Initial restricted area whis auth middleware
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'salary' => 'required|numeric',
            'pid' => 'required|numeric',
            ]);

        $employee = Employee::find($request->id);
        $employee->name = $request->name;
        $employee->salary = $request->salary;
        $employee->pid =    $request->pid;
        $employee->save();

        return redirect()->route('index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //dump($id);
    }

    /**
     * There is no need to validate $id because that is the restricted area
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $employee = Employee::find($id);
        $newBosses = $employee->position_id <= 4 ? $employee->position_id - 1 : 4;
        $bosses = Employee::get()->where('position_id', $newBosses);
        $bossName = Employee::find($employee->pid)->name; 

        $var = [
            'id' => $employee->id,
            'name' => $employee->name,
            'bossName' => $bossName,
            'position_id' => $employee->position->position,
            'salary' => $employee->salary,
            'bosses' => $bosses,
            'cid' => $employee->cid->count(),
            'work' => $employee->start_work,
        ];

        return view('edit')->with($var);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Employee::destroy($id);
        return redirect()->route('index');
    }
}
