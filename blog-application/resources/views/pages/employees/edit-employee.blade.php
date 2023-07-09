@extends('layout.app')
@section('content')
<style>
    .input-group-text{
        border: 0.0625rem solid #ced4da !important;
        border-radius: 0.125rem !important ;
    }
    </style>
    <div class="container-fluid">
        <a href="{{route('employees')}}">Go Back</a>
        <div class="card shadow mb-4">
            @foreach ($employee as $value )
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" style="text-transform: capitalize;">{{$value->full_name}}</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        @if (Session::has('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        @if (Session::has('error'))
                            <div class="alert alert-danger">
                                <ul>
                                    <li>{{ Session::get('error') }}</li>
                                </ul>
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>

                
                <form  method="post" id="editEmployerForm" >
                    @csrf
                    <input type="hidden" name="id"  value="{{$value->id}}">

                    <div class="row">
                        <div class="col-md-6">
        
                        <div class="form-group">
                        <label for="full_name">Full Name</label>
                        <input type="text" class="form-control" id="full_name" name="full_name"  value="{{$value->full_name}}">
                        </div>
                        </div>
        
                        <div class="col-md-6">
                        <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email"  value="{{$value->email}}">
                        </div>
                        </div>
        
        
                        <div class="col-md-6">
                        <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="tel" class="form-control" id="phone" name="phone"  value="{{$value->phone}}">
                        </div>
                        </div>
        
                        <div class="col-md-6">
                        <div class="form-group">
                        <label for="salary">Salary</label>
                        <input type="number" class="form-control" id="salary" name="salary" step="0.01" 
                        value="{{$value->salary}}">
                        </div>
                        </div>

                           <?php
                           $department=DB::table('departments')->where('id', $value->department_id)->first();
                           $departments=DB::table('departments')->where('id', '!=', $value->department_id)->get();
                           ?>
        
                        <div class="col-md-6">
                        <div class="form-group">
                        <label for="department_id">Department</label>
                        <select class="form-control" id="department_id" name="department_id" required>
                        <option value="0"  disabled>Select Department</option>
                       
                        <option value="{{$department->id}}">{{$department->department_name}} </option>

                        @foreach ($departments as $item )
                        <option value="{{$item->id}}">{{$item->department_name}} </option>
                        @endforeach
                        </select>
                        </div>
        
                        </div>
        
                        <div class="col-md-6">
                        <div class="form-group">
                        <label>Status</label>
                        <select  class="form-control" name="status" required>
                            <option value="0" disabled>Select Status</option>
            
                            @if ($value->status == 1)
                            <option value="1">Active </option>
                            <option value="0">Inactive </option>
                            @else
                            <option value="0">Inactive </option>
                            <option value="1">Active </option>

                            @endif

        
        
                        </select>                       
                        </div>
                        </div>
        
        
        
                        </div>
                   
                    
                   
             <input type="submit"  value="Update" class="btn btn-primary form-control">
            @endforeach    
            </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

<script>
    
    $(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name=csrf_token]').attr('content')
            }

        });
        $('#editEmployerForm').on('submit', function(e) {
            e.preventDefault();
            //$('#submitButton').prop('disabled', true);

            $.ajax({
                type: "POST",
                url: "{{ route('edit-employee', ['id' => $value->id]) }}",
                data: $(this).serialize(),
                success: function(data) {
                    if (data.success) {
                        swal({
                            icon: 'success',
                            title: 'UPDATED',
                            text: "Data has been updated successfully!",
                            confirmButtonColor: '#132F55',

                        })

                    }

                },
                error: function(data) {
                    if (data?.responseJSON?.error) {
                       
                        swal({
                            icon: 'error',
                            title: "FAILED",
                            text: "Something went wrong. Please try again!",
                        })
                    }
                    
                }

            })
        })

    });
</script>


    
@endsection