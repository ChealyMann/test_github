@extends('layouts.master')
@section('title','Edit-Employee')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Employee</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/employee')}}">Employee</a></li>
                        <li class="breadcrumb-item active">Edit Employee</li>
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
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <form action="{{ route('employee.update', $employee->employee_id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">

                                <!-- Full Name -->
                                <div class="form-group">
                                    <label>Full Name <code class="text-danger">*</code></label>
                                    <input type="text" name="full_name" class="form-control" value="{{ old('full_name', $employee->full_name) }}">
                                    @error('full_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Gender -->
                                <div class="form-group">
                                    <label>Gender <code class="text-danger">*</code></label>
                                    <select name="gender" class="form-control">
                                        <option value="">-- Select Gender --</option>
                                        <option value="Male" {{ old('gender', $employee->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ old('gender', $employee->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                                    </select>
                                    @error('gender')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Date of Birth -->
                                <div class="form-group">
                                    <label>Date of Birth</label>
                                    <input type="date" name="dob" class="form-control" value="{{ old('dob', $employee->dob) }}">
                                </div>

                                <div class="form-group">
                                    <label>NationalID</label>
                                    <input type="text" name="national_id" class="form-control" value="{{ old('national_id', $employee->national_id) }}">
                                </div>

                                <!-- Email -->
                                <div class="form-group">
                                    <label>Email <code class="text-danger">*</code></label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email', $employee->email) }}">
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Phone -->
                                <div class="form-group">
                                    <label>Phone Number <code class="text-danger">*</code></label>
                                    <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number', $employee->phone_number) }}">
                                    @error('phone_number')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Department -->
                                <div class="form-group">
                                    <label>Department <code class="text-danger">*</code></label>
                                    <select name="department_id" class="form-control">
                                        <option value="">-- Select Department --</option>
                                        @foreach($departments as $dept)
                                            <option value="{{ $dept->department_id }}" {{ old('department_id', $employee->department_id) == $dept->department_id ? 'selected' : '' }}>
                                                {{ $dept->department_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('department_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Position -->
                                <div class="form-group">
                                    <label>Position <code class="text-danger">*</code></label>
                                    <select name="position_id" class="form-control">
                                        <option value="">-- Select Position --</option>
                                        @foreach($positions as $pos)
                                            <option value="{{ $pos->position_id }}" {{ old('position_id', $employee->position_id) == $pos->position_id ? 'selected' : '' }}>
                                                {{ $pos->position_title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('position_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Status -->
                                <div class="form-group">
                                    <label>Status</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" value="active" {{ old('status', $employee->status) == 'active' ? 'checked' : '' }}>
                                        <label class="form-check-label">Active</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" value="inactive" {{ old('status', $employee->status) == 'inactive' ? 'checked' : '' }}>
                                        <label class="form-check-label">Inactive</label>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
