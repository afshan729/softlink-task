<?php
  
namespace App\Imports;
  
use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
  
class EmployeesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Employee([
                'full_name' => $row['name'],
                'email'    => $row['email'], 
                'phone' => $row['phone'], 
                'salary' => $row['salary'], 
                'department' => $row['department'], 
                'status' => $row['status'], 
        ]);
    }
}