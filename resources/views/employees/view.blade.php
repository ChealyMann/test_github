@extends('layouts.master')
@section('title','View-Employee')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">View Employee</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/employee')}}">Employee</a></li>
                        <li class="breadcrumb-item active">View Employee</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Employee Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Full Name</label>
                                        <p>{{ $employee->full_name }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <p>{{ $employee->gender }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Date of Birth</label>
                                        <p>{{ $employee->dob }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>National ID</label>
                                        <p>{{ $employee->national_id }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <p>{{ $employee->email }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <p>{{ $employee->phone_number }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <p>{{ $employee->address }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Hire Date</label>
                                        <p>{{ $employee->hire_date }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Department</label>
                                        <p>{{ $employee->department->department_name }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Position</label>
                                        <p>{{ $employee->position->position_title }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Employee Type</label>
                                        <p>{{ $employee->employee_type }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <p>{{ $employee->status }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('employee.get_employee') }}" class="btn btn-secondary">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
