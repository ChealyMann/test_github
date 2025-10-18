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
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                {{--<h3 class="card-title">Responsive Hover Table</h3>--}}
                <div class="row">
                  <div class="col-3">
                    <a href="{{url('/department/create ')}}" class="btn btn-block btn-primary">
                      Add Department
                    </a>
                  </div>
                  <div class="col-9">
                    <div class="card-tools">
                      <div class="input-group input-group-sm" style="width: 150px;float:right">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                        <div class="input-group-append">
                          <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>DepartmentCode</th>
                      <th>DepartmentName</th>
                      <th>Description</th>
                      <th>status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if($departments->isEmpty())
                       <tr>
                          <td colspan="6" class="text-center; text-danger;">No Date Found</td>
                        </tr>
                    @else
                      @foreach ($departments as $key => $values )
                        <tr>
                          <td>{{++$key}}</td>
                          <td>{{$values ->department_name}}</td>
                          <td>{{$values ->department_code}}</td>
                          <td>{{$values ->description}}</td>
                          <td>
                            <span class="badge {{$values->status=='active' ? 'badge-success' : 'badge-danger'}} ">
                              {{$values ->status}}
                            </span>
                          </td>
                          <td colspan="2" class="project-actions text-right">
                              <a class="btn btn-primary btn-sm" href="{{url('department/'.$values->department_id)}}">
                                  <i class="fas fa-folder">
                                  </i>
                                  View
                              </a>
                              <a class="btn btn-info btn-sm" href="{{ route('department.edit', $values->department_id) }}">
                                  <i class="fas fa-pencil-alt">
                                  </i>
                                  Edit
                              </a>
                              <form action="{{ route('department.destroy', $values->department_id) }}" method="POST" style="display:inline-block;">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this department?')">
                                      <i class="fas fa-trash"></i> Delete
                                  </button>
                              </form>
                          </td>
                        </tr>
                      @endforeach
                    @endif 
                  </tbody>
                </table>
              </div>
              {{$departments->links('pagination::bootstrap-4')}}
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
