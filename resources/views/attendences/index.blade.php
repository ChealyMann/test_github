@extends('layouts.master')
@section('title','department')


@section('content')
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Department</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Department</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->

        <div class="row mb-2">
          <div class="col-sm-12">
            @if (Session::has ('success'))
              <div class="alert alert-success" role="alert">
                {{Session::get('success')}}
              </div>
            @endif

             @if (Session::has ('danger'))
              <div class="alert alert-danger" role="alert">
                {{Session::get('danger')}}
              </div>
            @endif
          </div>
        </div>

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
