@extends('layout.app')
@section('content')
<style>
    .suppliers td{
        text-transform: capitalize;
    }
    </style>

 <!-- Begin Page Content -->
 <div class="container-fluid">
    
    <div class="row">
        <div class="col-md-12">
        <a href="#" class="btn btn-success" 
        style="float:right;margin-bottom: 10px; " data-toggle="tooltip" data-placement="top" title="Import from csv file">
        Import Employees </a>
    </div>
    </div>  
    <div class="row">
        <div class="col-md-12">
        <a href="#" class="btn btn-warning" 
        style="float:right;margin-bottom: 10px; " data-toggle="tooltip" data-placement="top" title="Export in excel file">
        Export Employees </a>
    </div>
    </div>   
 

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
                        @foreach ($employee as $value )
                        <?php
                        $department=DB::table('departments')->where('id',$value->department_id)->first();
                        ?>
                        <tr>
                            <td>
                                <input type="hidden" name="id"  value="{{$value->id}}">
                                {{$value->full_name}}</td>
                            <td style="text-transform: lowercase">{{$value->email }}</td>
                            <td>{{$value->phone}}</td>
                            <td>{{$value->salary}}</td>
                            <td>{{$department->department_name}}</td>
                            <td class="align-middle">
                                @if ($value->status == 1)
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

                               
                                <a href="{{ asset('employees/documents/' . $value->attachment) }}" 
                                    class="btn btn-warning btn-sm " 
                                     data-toggle="tooltip" data-placement="top" title="Download"  target="_blank">
                                    <i class="fa fa-download"></i></a>
                               
                                <a href="{{route('edit-employee', ['id' => $value->id])}}" 
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