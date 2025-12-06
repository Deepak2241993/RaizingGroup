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
                    <h1>Vendor Dashboard</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('master-dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Vendor Dashboard</li>
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
                            <h3 class="card-title">Vendor Overview</h3>
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

                                <!-- Vendor Active Tasks -->
                                <div class="col-lg-3 col-6">
                                    <div class="small-box bg-info">
                                        <div class="inner">
                                            <h3>{{ $activetask }}</h3>
                                            <p>Active Tasks</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-thumb-tack"></i>
                                        </div>
                                        <a href="{{route('vendor-task.index')}}" class="small-box-footer">
                                            More Info <i class="fas fa-arrow-circle-right"></i>
                                        </a>
                                    </div>
                                </div>

                                <!-- Vendor Completed Tasks -->
                                <div class="col-lg-3 col-6">
                                    <div class="small-box bg-success">
                                        <div class="inner">
                                            <h3>{{ $completedtask }}</h3>
                                            <p>Completed Tasks</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-check-square-o"></i>
                                        </div>
                                        <a href="{{route('vendor-task.index')}}" class="small-box-footer">
                                            More Info <i class="fas fa-arrow-circle-right"></i>
                                        </a>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="card-footer">
                            Vendor Panel Summary
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

</div>

@endsection
