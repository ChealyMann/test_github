@extends('layouts.master')
@section('title','Employee')

@section('content')
    <div class="content-wrapper">

        <!-- Page Header -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Employee JSON</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Employee</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-header -->

        <!-- Main Content -->
        <section class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">DataTable with default features</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="getEmployees" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Image</th>
                                        <th>Employee Code</th>
                                        <th>Fullname</th>
                                        <th>Gender</th>
                                        <th>Date of Birth</th>
                                        <th>National</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>HireDate</th>
                                        <th>Type</th>
                                        <th>Address</th>
                                        <th>Position</th>
                                        <th>Department</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection

@section('datatable_css')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css') }}">
@endsection

@section('datatable_js')
    <!-- DataTables & Plugins -->
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>


    <!-- SweetAlert2 -->
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
@endsection

@section('datatable_script')
    <script>
        $(document).ready(function () {
            var table =$('#getEmployees').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/employee/get_employee_json', // your controller endpoint
                    dataSrc: function (json) {
                        // Return the data for DataTables
                        return json.data;
                    }
                },
                columns: [
                    {
                        data: null, // Use the 'id' from your data (important)
                        name: 'index',
                        render: function (data, type, row, meta) {
                            return meta.row + 1; // Display row index + 1
                        }
                    },
                    { data: 'profile_photo', name: 'profile_photo' },
                    { data: 'employee_code', name: 'employee_code' },
                    { data: 'full_name', name: 'full_name' },
                    { data: 'gender', name: 'gender' },
                    { data: 'dob', name: 'dob', width: '30%' },
                    { data: 'national_id', name: 'national_id' },
                    { data: 'email', name: 'email' },
                    { data: 'phone_number', name: 'phone_number' },
                    { data: 'hire_date', name: 'hire_date' },
                    { data: 'employee_type', name: 'employee_type' },
                    { data: 'address', name: 'address' },
                    { data: 'position_title', name: 'position_title' },
                    { data: 'department_name', name: 'department_name' },
                    { data: 'status', name: 'status' },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return data;
                        }
                    }
                ],
                createdRow: function(row, data, dataIndex) {
                    // Set background color of column index 2 (employee_code)
                    $('td:eq(2)', row).css('background-color', '#e0ffe0'); // light green
                }
            });
        });
    </script>
@endsection
