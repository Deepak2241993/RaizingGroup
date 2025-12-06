@extends('layouts.masteradmin')
@section('body')

<div class="content-wrapper">

    <!-- Page Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Employee Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="content">

        <div class="container-fluid">

            <div class="row">

                <!-- Active Tasks -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $activetask }}</h3>
                            <p>Active Tasks</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-thumb-tack"></i>
                        </div>
                        <a href="{{ route('employeetaskview') }}" class="small-box-footer">
                            More Info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Task Completed -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $completedtask }}</h3>
                            <p>Task Completed</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-check-square-o"></i>
                        </div>
                        <a href="{{ route('employeetaskview') }}" class="small-box-footer">
                            More Info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Pending Tasks for Management -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $taskassignbyyou }}</h3>
                            <p>Pending Task For Management</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-tasks"></i>
                        </div>
                        <a href="{{ route('managementtask.index') }}" class="small-box-footer">
                            More Info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Completed Task For Management Team -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{ $completed }}</h3>
                            <p>Completed Task For Management</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-check-circle"></i>
                        </div>
                        <a href="{{ route('managementtask.index') }}" class="small-box-footer">
                            More Info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

            </div>

        </div>

    </section>

</div>

@endsection
