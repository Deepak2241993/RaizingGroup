@extends('layouts.masteradmin')
@section('body')

<div class="content-wrapper">

    <!-- Header -->
    <section class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Employee's Holidays</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('master-admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Holiday List</li>
                    </ol>
                </div>
            </div>

        </div>
    </section>

    <!-- Main Body -->
    <section class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-body">

                    <h5 class="mb-3">Employee's Holidays</h5>

                    @if(session('message'))
                        <p class="text-success fw-bold">{{ session('message') }}</p>
                    @endif

                    <div class="table-responsive mt-3">

                        <table id="example1" class="table table-bordered table-striped">

                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Holiday Name</th>
                                    <th>Holiday Date</th>
                                    <th>Holiday Day</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($holidays as $key=>$value)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $value }}</td>
                                    <td>{{ $date[$key] }}</td>
                                    <td>{{ $day[$key] }}</td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>

                    </div>

                    {{-- Pagination (disabled in original code)
                    {{ $holidays->links('vendor.pagination.simple-bootstrap-4') }}
                    --}}

                </div>
            </div>

        </div>
    </section>

</div>

@endsection
