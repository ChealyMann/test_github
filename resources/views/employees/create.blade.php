@extends('layouts.master')
@section('title','Create-Employee')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create Employee</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/employee')}}">Employee</a></li>
                        <li class="breadcrumb-item active">Create Employee</li>
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
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('employee.store') }}" method="POST">
                                @csrf
                                <div class="card-body">

                                    <!-- Full Name -->
                                    <div class="form-group">
                                        <label>Full Name <code class="text-danger">*</code></label>
                                        <input type="text" name="full_name" class="form-control" value="{{ old('full_name') }}">
                                        @error('full_name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <!-- Gender -->
                                    <div class="form-group">
                                        <label>Gender <code class="text-danger">*</code></label>
                                        <select name="gender" class="form-control">
                                            <option value="">-- Select Gender --</option>
                                            <option value="Male" {{ old('gender')=='Male' ? 'selected' : '' }}>Male</option>
                                            <option value="Female" {{ old('gender')=='Female' ? 'selected' : '' }}>Female</option>
                                        </select>
                                        @error('gender')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <!-- Date of Birth -->
                                    <div class="form-group">
                                        <label>Date of Birth</label>
                                        <input type="date" name="dob" class="form-control" value="{{ old('dob') }}">
                                        @error('dob')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>NationalID</label>
                                        <input type="text" name="national_id" class="form-control" value="{{ old('national_id') }}">
                                        @error('national_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <!-- Email -->
                                    <div class="form-group">
                                        <label>Email <code class="text-danger">*</code></label>
                                        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <!-- Phone -->
                                    <div class="form-group">
                                        <label>Phone Number <code class="text-danger">*</code></label>
                                        <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number') }}">
                                        @error('phone_number')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <!-- Address -->
                                    <div class="form-group">
                                        <label>Address</label>
                                        <textarea name="address" class="form-control">{{ old('address') }}</textarea>
                                        @error('address')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <!-- Hire Date -->
                                    <div class="form-group">
                                        <label>Hire Date</label>
                                        <input type="date" name="hire_date" class="form-control" value="{{ old('hire_date') }}">
                                        @error('hire_date')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <!-- Department -->
                                    <div class="form-group">
                                        <label>Department <code class="text-danger">*</code></label>
                                        <select name="department_id" class="form-control">
                                            <option value="">-- Select Department --</option>
                                            @foreach($departments as $dept)
                                                <option value="{{ $dept->department_id }}" {{ old('department_id')==$dept->department_id ? 'selected' : '' }}>
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
                                                <option value="{{ $pos->position_id }}" {{ old('position_id')==$pos->position_id ? 'selected' : '' }}>
                                                    {{ $pos->position_title }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('position_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <!-- Employee Type -->
                                    <div class="form-group">
                                        <label>Employee Type</label>
                                        <select name="employee_type" class="form-control">
                                            <option value="">-- Select Type --</option>
                                            <option value="Full-time" {{ old('employee_type')=='Full-time' ? 'selected' : '' }}>Full-time</option>
                                            <option value="Part-time" {{ old('employee_type')=='Part-time' ? 'selected' : '' }}>Part-time</option>
                                            <option value="Contract" {{ old('employee_type')=='Contract' ? 'selected' : '' }}>Contract</option>
                                        </select>
                                        @error('employee_type')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <!-- Status -->
                                    <div class="form-group">
                                        <label>Status</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" value="active" checked>
                                            <label class="form-check-label">Active</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" value="inactive">
                                            <label class="form-check-label">Inactive</label>
                                        </div>
                                        @error('status')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
