@extends('layouts.masteradmin')
@section('body')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Dashboard</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

           <div class="row">
                    <div class="col-12">
                        <!-- Default box -->
                        <div class="card p-2">                         
                            <div class="row">

                                <!-- Total Employees -->
                                <div class="col-lg-3 col-6">
                                    <div class="small-box bg-info">
                                        <div class="inner">
                                            <h3>{{ $employee }}</h3>
                                            <p>Total Employees</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-user"></i>
                                        </div>
                                        <a href="#" class="small-box-footer">
                                            More Info <i class="fas fa-arrow-circle-right"></i>
                                        </a>
                                    </div>
                                </div>

                                <!-- Total Admin -->
                                <div class="col-lg-3 col-6">
                                    <div class="small-box bg-success">
                                        <div class="inner">
                                            <h3>{{ $admin }}</h3>
                                            <p>Total Admin</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-user-secret"></i>
                                        </div>
                                        <a href="#" class="small-box-footer">
                                            More Info <i class="fas fa-arrow-circle-right"></i>
                                        </a>
                                    </div>
                                </div>

                                <!-- Total Vendor -->
                                <div class="col-lg-3 col-6">
                                    <div class="small-box bg-warning">
                                        <div class="inner">
                                            <h3>{{ $vendor }}</h3>
                                            <p>Total Vendor</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-users"></i>
                                        </div>
                                        <a href="#" class="small-box-footer">
                                            More Info <i class="fas fa-arrow-circle-right"></i>
                                        </a>
                                    </div>
                                </div>

                                <!-- Employee Pending Task -->
                                <div class="col-lg-3 col-6">
                                    <div class="small-box bg-danger">
                                        <div class="inner">
                                            <h3>{{ $emptask }}</h3>
                                            <p>Employee Pending Task</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-thumb-tack"></i>
                                        </div>
                                        <a href="#" class="small-box-footer">
                                            More Info <i class="fas fa-arrow-circle-right"></i>
                                        </a>
                                    </div>
                                </div>

                                <!-- Admin Pending Task -->
                                <div class="col-lg-3 col-6">
                                    <div class="small-box bg-primary">
                                        <div class="inner">
                                            <h3>{{ $admintask }}</h3>
                                            <p>Admin Pending Task</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-tasks"></i>
                                        </div>
                                        <a href="#" class="small-box-footer">
                                            More Info <i class="fas fa-arrow-circle-right"></i>
                                        </a>
                                    </div>
                                </div>

                                <!-- Vendor Pending Task -->
                                <div class="col-lg-3 col-6">
                                    <div class="small-box bg-secondary">
                                        <div class="inner">
                                            <h3>{{ $vendortask }}</h3>
                                            <p>Vendor Pending Task</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-tasks"></i>
                                        </div>
                                        <a href="#" class="small-box-footer">
                                            More Info <i class="fas fa-arrow-circle-right"></i>
                                        </a>
                                    </div>
                                </div>

                                <!-- Employee Leave Approval Pending -->
                                <div class="col-lg-3 col-6">
                                    <div class="small-box bg-info">
                                        <div class="inner">
                                            <h3>{{ $empleave }}</h3>
                                            <p>Employee Leave Approval Pending</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <a href="#" class="small-box-footer">
                                            More Info <i class="fas fa-arrow-circle-right"></i>
                                        </a>
                                    </div>
                                </div>

                                <!-- Admin Leave Approval Pending -->
                                <div class="col-lg-3 col-6">
                                    <div class="small-box bg-warning">
                                        <div class="inner">
                                            <h3>{{ $adminleave }}</h3>
                                            <p>Admin Leave Approval Pending</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <a href="#" class="small-box-footer">
                                            More Info <i class="fas fa-arrow-circle-right"></i>
                                        </a>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-footer-->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
