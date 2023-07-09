<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Exports\EmployeesExport;
use App\Imports\EmployeesImport;

use Maatwebsite\Excel\Facades\Excel; 


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //All employees should be listed in descending order by their creation date.
        $employee = Employee::orderBy('created_at', 'desc')->get();

        return view('pages.employees.employees', compact('employee'));
    }

   
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->isMethod('POST')) {

           // Validate the form data
    $validatedData = $request->validate([
        'full_name' => 'required',
        'email' => [
            'required',
            'email',
            Rule::unique(Employee::class),
        ],
        'phone' => 'required',
        'salary' => ['required', 
                        'regex:/^\d+(\.\d{1,2})?$/'],
        'department_id' => 'required|exists:departments,id',
        'status' => 'required',
        'attachment' => 'file|mimes:pdf,doc,docx|max:2048', // Add allowed file types and size limit

    ]);


          // Create a new employee instance
    $employee = new Employee();
    $employee->full_name = $validatedData['full_name'];
    $employee->email = $validatedData['email'];
    $employee->phone = $validatedData['phone'];
    $employee->salary = $validatedData['salary'];
    $employee->department_id = $validatedData['department_id'];
    $employee->status = $validatedData['status'];

        // Handle attachment file upload
        if ($request->file('employee_doc')) {
            $fileName = time() . rand(1, 999) . '_' . $request->file('employee_doc')->getClientOriginalName();
            $request->file('employee_doc')->move(base_path('public/employees/documents/'), $fileName);
            $employee->attachment = $fileName;

        }
        


    // Save the employee
    $employee->save();
    return redirect()->route('add-employee')
    ->with('success', 'Employee created successfully!');

    

    }else{
        $departments= Department::get();

        return view('pages.employees.add-employees' , compact('departments'));
    }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if ($request->isMethod('POST')) {
                       // Validate the form data
    $validatedData = $request->validate([
        'full_name' => 'required',
        'email' => 'required|email',
        'phone' => 'required',
        'salary' => ['required', 
                        'regex:/^\d+(\.\d{1,2})?$/'],
        'department_id' => 'required|exists:departments,id',
        'status' => 'required',
    ]);

            $employee=Employee::where('id', $id)->first();
            $employee->full_name = $validatedData['full_name'];
            $employee->email = $validatedData['email'];
            $employee->phone = $validatedData['phone'];
            $employee->salary = $validatedData['salary'];
            $employee->department_id = $validatedData['department_id'];
            $employee->status = $validatedData['status'];

            if($employee->save()){

                return response()->json(['success' => true]);


            }else{

                return response()->json([
                    "message" => "Something went wrong!",
                    "status" => "error",
                ], 400);
               
            }


        }else{
            $employee=Employee::where('id', $id)->get();
            return view('pages.employees.edit-employee', compact('employee'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $employee=Employee::where('id', $request->id)->first();
        $employee->delete();
        return response()->json("Done");
    }

        //Export all Employee to a Excel file
        public function exportEmployees()
        {
        return Excel::download(new EmployeesExport(), 'employees.xlsx');
        }

        
        //Import Employees from a csv file
        public function import() 
        {
        Excel::import(new EmployeesImport,request()->file('file'));

        return back();
        }

}
