@extends('layout.app')
@section('content')
<style>
    .input-group-text{
        border: 0.0625rem solid #ced4da !important;
        border-radius: 0.125rem !important ;


    }
    </style>
    <div class="container-fluid">
        <a href="{{route('employee')}}">Go Back</a>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Create a new Employee </h6>
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

                <form action="{{route('add-employee')}}" method="post"  enctype="multipart/form-data">
                    @csrf
                <div class="row">
                        <div class="col-12">
                           
                            <div class="form-group">
                                <label for="employee_doc">Upload Document<b class="text-danger">(Required)</b> &nbsp;&nbsp;<i
                                        class="fa fa-2x fa-upload" aria-hidden="true" style="cursor: pointer"></i>
                                    <span id="img-info" class="text-secondary"></span></label>
                                <input type="file" id="employee_doc" name="employee_doc" style="display: none"
                     onchange="$('#img-info').text(this.files[0].name)" >
                            </div>
                        </div>
                <div class="col-md-6">

                <div class="form-group">
                <label for="full_name">Full Name</label>
                <input type="text" class="form-control" id="full_name" name="full_name" required>
                </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
                </div>
                </div>


                <div class="col-md-6">
                <div class="form-group">
                <label for="phone">Phone</label>
                <input type="tel" class="form-control" id="phone" name="phone" required>
                </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                <label for="salary">Salary</label>
                <input type="number" class="form-control" id="salary" name="salary" step="0.01" required>
                </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                <label for="department_id">Department</label>
                <select class="form-control" id="department_id" name="department_id" required>
                <option value="0"  disabled>Select Department</option>
               
                @foreach ($departments as $department )
                <option value="{{$department->id}}">{{$department->department_name}} </option>
                @endforeach

                </select>
                </div>

                </div>

                <div class="col-md-6">
                <div class="form-group">
                <label>Status</label>
                <select  class="form-control" name="status" required>
                <option value="0" disabled>Select Status</option>


                <option value="1">Active </option>
                <option value="0">Inactive </option>


                </select>                       
                </div>
                </div>



                </div>

                    
                    <input type="submit"  value="SAVE" class="btn btn-primary form-control">
                </form>
            </div>
        </div>
    </div>
@endsection
