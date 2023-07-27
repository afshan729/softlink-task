<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
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
        $employees = Employee::with('department')->orderBy('created_at', 'desc')->get();

        return view('pages.employees.employees', compact('employees'));
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
            $file_n = request()->file('file');
            //$file = fopen($file_n, "r");
            $all_data = [];

            if ($file_n) {
                $handle = fopen($file_n->getRealPath(), "r");
            
            while (($data = fgetcsv($handle, 200, ",")) !==FALSE) {

                $full_name = $data[0];
                $email = $data[1];
                $phone = $data[2];
                $salary = $data[3];
                $department_id = $data[4];
                $status = $data[5];
                $attachment = $data[6];
                $all_data[] = $full_name. " ".$email. " ".$phone. " ".$salary. " ".$department_id. " ".$status. " ".$attachment;
                //dd($all_data);
                //array_push($array, $all_data);
                $employee = new Employee();
                $employee->full_name = $full_name;
                $employee->email = $email;
                $employee->phone = $phone;
                $employee->salary = $salary;
                $employee->department_id = $department_id;
                $employee->status = $status;
                $employee->attachment = $attachment;
                $employee->save();

                return back();
            }
            fclose($handle);

        }
            
                // $all_data now contains the names and cities from the CSV file
                // Excel::import(new EmployeesImport,request()->file('file'));
                // return back();
        }

}
