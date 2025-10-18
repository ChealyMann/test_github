<?php

namespace App\Http\Controllers\backend;

use App\Models\Employee;
use App\Models\Positions;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $employees = DB::table('employees as e')
            ->join('departments as d', 'e.department_id', '=', 'd.department_id')
            ->join('positions as p', 'e.position_id', '=', 'p.position_id')
            ->select('e.*', 'd.department_name', 'p.position_title', 'e.status')
            ->get();


        return view('employees.index', compact('employees'));
    }

    public function get_employee(){
        return view('employees.get_employee');
    }


    public function get_employee_json(Request $request){
        //Using Eloquent
        //$employees = Employee::with(['department', 'position'])->get();

        //Using Query Builder
        $draw = $request->input('draw');
        $start = $request->input('start');
        $length = $request->input('length');

        $query = DB::table('employees as e')
            ->join('departments as d', 'e.department_id', '=', 'd.department_id')
            ->join('positions as p', 'e.position_id', '=', 'p.position_id')
            ->select(
                'e.*',
                'd.department_name',
                'p.position_title'
            ); //->get();

        // Apply search if needed
        if ($request->has('search') && $request->input('search.value')) {
            $searchValue = $request->input('search.value');
            $query->where('e.full_name', 'like', '%' . $searchValue . '%'); // Adjust your search criteria
        }

        // Get the SQL query
        $sql = $query->skip($start)->take($length)->toSql();

        $filteredRecords = $query->count(); // Count after filtering
        $totalRecords = DB::table('employees')->count(); // Total count


        $data = $query->get()->map(function ($employee) {
            $actions = '<a href="' . route('employee.show', $employee->employee_id) . '" class="btn btn-sm btn-info">View</a>';
            $actions .= ' <a href="' . route('employee.edit', $employee->employee_id) . '" class="btn btn-sm btn-primary">Edit</a>';
            $actions .= ' <form action="' . route('employee.destroy', $employee->employee_id) . '" method="POST" style="display:inline-block;">';
            $actions .= csrf_field() . method_field('DELETE');
            $actions .= '<button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure?\')">Delete</button>';
            $actions .= '</form>';

            $employee->actions = $actions;
            return $employee;
        });

        // Prepare the response for DataTables (or your client)
        $response = [
            'draw' => intval($draw),
            'recordsTotal' => intval($totalRecords),
            'recordsFiltered' => intval($filteredRecords),
            'data' => $data,
            'sql' => $sql, // Add the SQL to the response
        ];

        return response()->json($response);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        $positions   = Positions::all();
        return view('employees.create',compact('departments', 'positions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
        {
            $request->validate([
            'full_name'     => 'required|string|max:255',
            'gender'        => 'required',
            'email'         => 'required|email|unique:employees,email',
            'phone_number'  => 'required',
            'department_id' => 'required|exists:departments,department_id',
            'position_id'   => 'required|exists:positions,position_id',
        ]);

        Employee::create([
            'full_name'     => $request->full_name,
            'gender'        => $request->gender,
            'dob'           => $request->dob,
            'email'         => $request->email,
            'phone_number'  => $request->phone_number,
            'department_id' => $request->department_id,
            'position_id'   => $request->position_id,
            'status'        => $request->status,
        ]);

        return redirect()->route('employee.index')->with('success', 'Employee created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employee::findOrFail($id);
        return view('employees.view', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
