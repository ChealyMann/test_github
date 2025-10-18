<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {       
         $departments = Department::orderBy('department_id','desc')->paginate(5);
         return view('departments.index',['departments'=>$departments]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Example code
        $code ='departmentcode';
        // Get current date and time
        $currentDateTime = now(); // Laravel's helper for the current date and time
        // Format the datetime to include in the code
        $formattedDateTime = $currentDateTime->format('YmdHis'); // Example: 20241209153045 (YYYYMMDDHHMMSS)

        // Generate a random string
        $randomString = strtoupper(substr(md5(uniqid($code, true)), 0, 6)); // Example: A1B2C3

        // Combine formatted date, time, and random string
        $randomCode = 'DPT'.$formattedDateTime . '-' . $randomString;

         return view('departments.create',compact('randomCode'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validationData = $request->validate(
            [
                    'department_code' => 'required',
                    'department_name' => 'required|string|max:10',
                   ]
        );

        Department::create([
            'department_code' => $request->department_code,
            'department_name' => $request->department_name,
            'description'     => $request->description,
            'status'          => $request->status,
        ]);
        session()->flash('success','Your Data is Save');
        return redirect()->route('department.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $department = Department::findOrFail($id); 
        return view('departments.view', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         $department = Department::findOrFail($id);
         return view('departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $request->validate([
        'department_code' => 'required',
        'department_name' => 'required|string|max:10',
        ]);

        $department = Department::findOrFail($id);
        $department->department_code = $request->department_code;
        $department->department_name = $request->department_name;
        $department->description = $request->description;
        $department->status = $request->status;
        $department->save();

        return redirect()->route('department.index')->with('success', 'Department updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $department = Department::findOrFail($id);
        $department->delete();

        return redirect()->route('department.index')->with('danger', 'Department deleted successfully.');
    }
}
