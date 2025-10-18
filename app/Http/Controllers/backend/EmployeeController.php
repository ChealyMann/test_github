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
        $employees = Employee::with(['department', 'position'])->get();
        return view('employees.index', compact('employees'));
    }

    public function get_employee(){
        return view('employees.get_employee');
    }


    public function get_employee_json(Request $request)
    {
        $draw = $request->input('draw');
        $start = $request->input('start');
        $length = $request->input('length');
        $searchValue = $request->input('search.value');

        // Base query
        $query = Employee::with(['department', 'position']);

        // Get total records count
        $totalRecords = $query->count();

        // Apply search filter
        if (!empty($searchValue)) {
            $query->where(function ($q) use ($searchValue) {
                $q->where('full_name', 'like', '%' . $searchValue . '%')
                    ->orWhere('email', 'like', '%' . $searchValue . '%')
                    ->orWhereHas('department', function ($q) use ($searchValue) {
                        $q->where('department_name', 'like', '%' . $searchValue . '%');
                    })
                    ->orWhereHas('position', function ($q) use ($searchValue) {
                        $q->where('position_title', 'like', '%' . $searchValue . '%');
                    });
            });
        }

        // Get filtered records count
        $filteredRecords = $query->count();

        // Apply ordering
        if ($request->has('order')) {
            $orderColumnIndex = $request->input('order.0.column');
            $orderDirection = $request->input('order.0.dir');
            $columns = ['employee_id', 'profile_photo', 'full_name', 'gender', 'dob', 'national_id', 'email', 'phone_number', 'hire_date', 'employee_type', 'address', 'position_title', 'department_name', 'status'];

            if (isset($columns[$orderColumnIndex])) {
                $orderColumn = $columns[$orderColumnIndex];
                if ($orderColumn == 'department_name') {
                    $query->select('employees.* ')
                        ->join('departments', 'employees.department_id', '=', 'departments.department_id')
                        ->orderBy('departments.department_name', $orderDirection);
                } elseif ($orderColumn == 'position_title') {
                    $query->select('employees.* ')
                        ->join('positions', 'employees.position_id', '=', 'positions.position_id')
                        ->orderBy('positions.position_title', $orderDirection);
                } else {
                    $query->orderBy($orderColumn, $orderDirection);
                }
            }
        }

        // Apply pagination
        $employees = $query->skip($start)->take($length)->get();

        $data = $employees->map(function ($employee) {
            $actions = '<a href="' . route('employee.show', $employee->employee_id) . '" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a> ';
            $actions .= '<a href="' . route('employee.edit', $employee->employee_id) . '" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a> ';
            $actions .= '<form action="' . route('employee.destroy', $employee->employee_id) . '" method="POST" style="display:inline-block;">';
            $actions .= csrf_field() . method_field('DELETE');
            $actions .= '<button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure?\')"><i class="fas fa-trash"></i></button>';
            $actions .= '</form>';

            $status = '';
            if ($employee->status == 'active') {
                $status = '<span class="badge badge-success">Active</span>';
            } else {
                $status = '<span class="badge badge-danger">Resigned</span>';
            }

            $employee->actions = $actions;
            $employee->status = $status;
            $employee->department_name = $employee->department->department_name;
            $employee->position_title = $employee->position->position_title;
            return $employee;
        });

        $response = [
            'draw' => intval($draw),
            'recordsTotal' => intval($totalRecords),
            'recordsFiltered' => intval($filteredRecords),
            'data' => $data,
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
            'dob'           => 'required|date',
            'national_id'   => 'required|string|max:255|unique:employees,national_id',
            'email'         => 'required|email|unique:employees,email',
            'phone_number'  => 'required',
            'address'       => 'required|string',
            'hire_date'     => 'required|date',
            'department_id' => 'required|exists:departments,department_id',
            'position_id'   => 'required|exists:positions,position_id',
            'employee_type' => 'required|in:Full-time,Part-time,Contract',
            'status'        => 'required|in:active,resigned',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('profile_photo')) {
            $image = $request->file('profile_photo');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('storage/profile_photos'), $imageName);
            $data['profile_photo'] = 'profile_photos/'.$imageName;
        }

        Employee::create($data);

        return redirect()->route('employee.get_employee')->with('success', 'Employee created successfully!');
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
        $employee = Employee::findOrFail($id);
        $departments = Department::all();
        $positions = Positions::all();
        return view('employees.edit', compact('employee', 'departments', 'positions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'full_name'     => 'required|string|max:255',
            'gender'        => 'required',
            'dob'           => 'required|date',
            'national_id'   => 'required|string|max:255|unique:employees,national_id,' . $id . ',employee_id',
            'email'         => 'required|email|unique:employees,email,' . $id . ',employee_id',
            'phone_number'  => 'required',
            'address'       => 'required|string',
            'hire_date'     => 'required|date',
            'department_id' => 'required|exists:departments,department_id',
            'position_id'   => 'required|exists:positions,position_id',
            'employee_type' => 'required|in:Full-time,Part-time,Contract',
            'status'        => 'required|in:active,resigned',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $employee = Employee::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('profile_photo')) {
            // Delete old photo if it exists
            if ($employee->profile_photo && file_exists(public_path('storage/' . $employee->profile_photo))) {
                unlink(public_path('storage/' . $employee->profile_photo));
            }

            $image = $request->file('profile_photo');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('storage/profile_photos'), $imageName);
            $data['profile_photo'] = 'profile_photos/'.$imageName;
        }

        $employee->update($data);

        return redirect()->route('employee.get_employee')->with('success', 'Employee updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect()->route('employee.get_employee')->with('success', 'Employee deleted successfully!');
    }
}
