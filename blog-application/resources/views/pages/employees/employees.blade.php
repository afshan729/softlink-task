@extends('layout.app')
@section('content')


 <!-- Begin Page Content -->
 <div class="container-fluid">
    <div class="card bg-light mt-3">
        
        <div class="card-body">
            <form action="{{ route('employees.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="">
                <br><br>
                <button type="submit" class="btn btn-success">Import Employees</button>
            </form>
        </div>
    </div>
<br>

   
    <form action="#" method="POST" name="importform"
	  enctype="multipart/form-data">
		@csrf	
        <div class="row">
        <div class="col-md-12">
        <a href="{{route('employees.export')}}" class="btn btn-info" 
        style="float:right;margin-bottom: 10px; " data-toggle="tooltip" data-placement="top" title="Export in excel file">
        Export Employees </a>
    </div>
    </div>   
 
    </form>
    

    <div class="row">
        <div class="col-md-12">
        <a href="{{route('add-employee')}}" class="btn btn-primary" 
        style="float:right;margin-bottom: 10px; " data-toggle="tooltip" data-placement="top" title="Add">Create a new Employee </a>
    </div>
    </div>   
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Employees</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered employees" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Salary</th>
                            <th>Department</th>
                            <th>Status</th>
                            <th>Action</th>
                           </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Salary</th>
                            <th>Department</th>
                            <th>Status</th>
                            <th>Action</th>
                              
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($employees as $employee )

                        <tr>
                            <td>
                            <input type="hidden" name="id"  value="{{$employee->id}}">
                                {{$employee->full_name}}</td>
                            <td style="text-transform: lowercase">{{$employee->email }}</td>
                            <td>{{$employee->phone}}</td>
                            <td>{{$employee->salary}}</td>
                            <td>{{$employee->department->department_name}}</td>
                            <td class="align-middle">
                                @if ($employee->status == 1)
                                <div>
                                   <span class="bg-success-transparent text-info px-2 py-1 br-7 border-success">Active</span>
                               </div>
                               @else
                               <div>
                                   <span class="bg-danger-transparent text-info px-2 py-1 br-7 border-danger">Inactive</span>
                               </div>
                                @endif
                                   
                               </td>   

                            <td>

                               
                                <a href="{{ asset('employees/documents/' . $employee->attachment) }}" 
                                    class="btn btn-warning btn-sm " 
                                     data-toggle="tooltip" data-placement="top" title="Download"  target="_blank">
                                    <i class="fa fa-download"></i></a>
                               
                                <a href="{{route('edit-employee', ['id' => $employee->id])}}" 
                                    class="btn btn-success btn-sm " type="button" 
                                    data-toggle="tooltip" data-placement="top" title="Edit">
                                    <i class="fa fa-edit"></i></a>
                                   
                                   
    
                                    <button class="btn btn-danger btn-sm delete" type="button" 
                                    data-toggle="tooltip" data-placement="top" title="Delete">
                                    <i class="fa fa-trash"></i></button>
                           
                            </td>
                            </tr>
                            @endforeach
                      
                       
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection


@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

<script>
    $(document).ready(function(){
        $(".employees").on("click", ".delete", function(){
                var currentRow = $(this).closest("tr");
                var id = currentRow.find("td:eq(0) input[type = hidden]").val();
                console.log(id);
                swal({
              title: `Are you sure to delete this record?`,
              text: "If you delete this, it will be gone forever.",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              $.ajax({
                    url: "{{route('delete-employee')}}",
                    method: "GET",
                    data:
                    {
                        id: id

                    },
                    success: function(data){
                        $(currentRow).remove();
                    }
                })
            }})
            });
       

    });
</script>
   
@endsection