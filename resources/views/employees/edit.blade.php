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
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('employee.update', $employee->employee_id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-header" style="background-color: #007bff; color: white;">
                                <h3 class="card-title">Department and Position</h3>
                            </div>
                            <div class="card-body">
                                <!-- Department -->
                                <div class="form-group">
                                    <label>Department <code class="text-danger">*</code></label>
                                    <select name="department_id" id="department_id" class="form-control">
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
                                    <select name="position_id" id="position_id" class="form-control">
                                        <option value="">-- Select Position --</option>
                                    </select>
                                    @error('position_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="card mt-4">
                            <div class="card-header" style="background-color: #007bff; color: white;">
                                <h3 class="card-title">Fill Employee</h3>
                            </div>
                            <div class="card-body">
                                <!-- Employee Code -->
                                <div class="form-group">
                                    <label>Employee Code <code class="text-danger">*</code></label>
                                    <input type="text" name="employee_code" class="form-control" value="{{ old('employee_code', $employee->employee_code) }}" readonly>
                                    @error('employee_code')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Full Name -->
                                <div class="form-group">
                                    <label>Full Name <code class="text-danger">*</code></label>
                                    <input type="text" name="full_name" class="form-control" value="{{ old('full_name', $employee->full_name) }}">
                                    @error('full_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Profile Photo -->
                                <div class="form-group">
                                    <label>Profile Photo</label>
                                    <input type="file" name="profile_photo" class="form-control">
                                    @error('profile_photo')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    @if($employee->profile_photo)
                                        <img src="{{ asset('storage/' . $employee->profile_photo) }}" alt="Profile Photo" width="100" class="mt-2">
                                    @endif
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
                                    @error('dob')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>NationalID</label>
                                    <input type="text" name="national_id" class="form-control" value="{{ old('national_id', $employee->national_id) }}">
                                    @error('national_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
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

                                <!-- Address -->
                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea name="address" class="form-control">{{ old('address', $employee->address) }}</textarea>
                                    @error('address')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Hire Date -->
                                <div class="form-group">
                                    <label>Hire Date</label>
                                    <input type="date" name="hire_date" class="form-control" value="{{ old('hire_date', $employee->hire_date) }}">
                                    @error('hire_date')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Employee Type -->
                                <div class="form-group">
                                    <label>Employee Type</label>
                                    <select name="employee_type" class="form-control">
                                        <option value="">-- Select Type --</option>
                                        <option value="Full-time" {{ old('employee_type', $employee->employee_type) == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                                        <option value="Part-time" {{ old('employee_type', $employee->employee_type) == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                                        <option value="Contract" {{ old('employee_type', $employee->employee_type) == 'Contract' ? 'selected' : '' }}>Contract</option>
                                    </select>
                                    @error('employee_type')
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
                                        <input class="form-check-input" type="radio" name="status" value="resigned" {{ old('status', $employee->status) == 'resigned' ? 'checked' : '' }}>
                                        <label class="form-check-label">Resigned</label>
                                    </div>
                                    @error('status')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('datatable_js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        var departmentId = $('#department_id').val();
        var positionId = '{{ old("position_id", $employee->position_id) }}';

        if (departmentId) {
            $('#position_id').prop('disabled', false);
            $.ajax({
                url: '/employees/get-positions-by-department/' + departmentId,
                type: "GET",
                dataType: "json",
                success:function(data) {
                    $('#position_id').empty().append('<option value="">-- Select Position --</option>');
                    $.each(data, function(key, value) {
                        var selected = (value.position_id == positionId) ? 'selected' : '';
                        $('#position_id').append('<option value="'+ value.position_id +'" '+ selected +'>'+ value.position_title +'</option>');
                    });
                }
            });
        } else {
            $('#position_id').prop('disabled', true);
        }

        $('#department_id').on('change', function() {
            var departmentId = $(this).val();
            if (departmentId) {
                $('#position_id').prop('disabled', false);
                $.ajax({
                    url: '/employees/get-positions-by-department/' + departmentId,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('#position_id').empty().append('<option value="">-- Select Position --</option>');
                        $.each(data, function(key, value) {
                            $('#position_id').append('<option value="'+ value.position_id +'">'+ value.position_title +'</option>');
                        });
                    }
                });
            } else {
                $('#position_id').prop('disabled', true);
                $('#position_id').empty().append('<option value="">-- Select Position --</option>');
            }
        });
    });
</script>
@endsection