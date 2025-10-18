@extends('layouts.master')
@section('title','Edit-Department')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Edit Department</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/department') }}">Department</a></li>
              <li class="breadcrumb-item active">Edit Department</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Department</h3>
              </div>

              <!-- form start -->
              <form action="{{ route('department.update', $department->department_id) }}" method="POST">
                  @csrf
                  @method('PUT')

                  <div class="card-body">
                      <div class="form-group">
                          <label>Department Code <code class="text-danger">*</code></label>
                          <input type="text" 
                                 name="department_code" 
                                 class="form-control" 
                                 value="{{ old('department_code', $department->department_code) }}">
                          @error('department_code')
                             <small class="text-danger">{{ $message }}</small> 
                          @enderror
                      </div>

                      <div class="form-group">
                          <label>Department Name <code class="text-danger">*</code></label>
                          <input type="text" 
                                 name="department_name" 
                                 class="form-control" 
                                 value="{{ old('department_name', $department->department_name) }}">
                          @error('department_name')
                             <small class="text-danger">{{ $message }}</small> 
                          @enderror
                      </div>

                      <div class="form-group">
                          <label>Description</label>
                          <textarea name="description" 
                                    class="form-control" 
                                    rows="3">{{ old('description', $department->description) }}</textarea>
                      </div>

                      <div class="form-group">
                          <label>Status</label>
                          <div class="form-check">
                              <input class="form-check-input" 
                                     type="radio" 
                                     name="status" 
                                     value="active" 
                                     {{ old('status', $department->status) == 'active' ? 'checked' : '' }}>
                              <label class="form-check-label">Active</label>
                          </div>
                          <div class="form-check">
                              <input class="form-check-input" 
                                     type="radio" 
                                     name="status" 
                                     value="inactive" 
                                     {{ old('status', $department->status) == 'inactive' ? 'checked' : '' }}>
                              <label class="form-check-label">Inactive</label>
                          </div>
                      </div>

                      <button type="submit" class="btn btn-primary">Update</button>
                  </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </section>
</div>
@endsection
