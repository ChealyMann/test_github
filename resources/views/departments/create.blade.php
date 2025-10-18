@extends('layouts.master')
@section('title','Create-Department')


@section('content')
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Create</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/department')}}">Department</a></li>
              <li class="breadcrumb-item active">Create Department</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
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
              <!-- /.card-header -->
              <!-- form start -->
                <form action="{{route('department.store')}}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Department Code <code class="text-danger">*</code></label>
                            <input type="text" name="department_code" value="{{$randomCode}}" class="form-control" readonly>
                            @error('department_code')
                               <small class="text-danger">{{$message}}</small> 
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Department Name <code class="text-danger">*</code></label>
                            <input type="text" name="department_name" value="{{old('department_name')}}" class="form-control">
                             @error('department_name')
                               <small class="text-danger">{{$message}}</small> 
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="discription" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                        </div>

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
                        </div>


                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>

            </div>
            <!-- /.card -->
            
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
