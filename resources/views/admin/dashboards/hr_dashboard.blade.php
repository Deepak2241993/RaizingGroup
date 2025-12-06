@extends('layouts.masteradmin')
@section('body')

<div class="content-wrapper">

    <!-- ============================
        PAGE HEADER
    ============================ -->
    <section class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1>HR Dashboard</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('master-dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">HR Dashboard</li>
                    </ol>
                </div>

            </div>

        </div>
    </section>

    <!-- ============================
        MAIN CONTENT
    ============================ -->
    <section class="content">
        <div class="container-fluid">

            <div class="row">

                <div class="col-12">

                    <div class="card">

                        <div class="card-header">
                            <h3 class="card-title">HR Overview</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>

                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body">

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
                                        <a href="#" class="small-box-footer">More Info <i class="fas fa-arrow-circle-right"></i></a>
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
                                        <a href="#" class="small-box-footer">More Info <i class="fas fa-arrow-circle-right"></i></a>
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
                                        <a href="#" class="small-box-footer">More Info <i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>

                                <!-- Employee Leave Pending -->
                                <div class="col-lg-3 col-6">
                                    <div class="small-box bg-primary">
                                        <div class="inner">
                                            <h3>{{ $empleave }}</h3>
                                            <p>Employee Leave Approval Pending</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <a href="#" class="small-box-footer">More Info <i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>

                                <!-- Admin Leave Pending -->
                                <div class="col-lg-3 col-6">
                                    <div class="small-box bg-danger">
                                        <div class="inner">
                                            <h3>{{ $adminleave }}</h3>
                                            <p>Admin Leave Approval Pending</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <a href="#" class="small-box-footer">More Info <i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="card-footer">
                            HR Management Summary
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </section>

</div>

@endsectionp
