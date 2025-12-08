@extends('layouts.masteradmin')

@section('body')

@push('csslink')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{url('/')}}/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{url('/')}}/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{url('/')}}/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endpush


<div class="content-wrapper">

    <!-- Page Header -->
    <section class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1>Web Login Details</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active">Web Login Details</li>
                    </ol>
                </div>

            </div>

        </div>
    </section>


    <!-- Main Page Content -->
    <section class="content">

        <div class="container-fluid">

            <div class="card">

                <div class="card-body">

                    <h4>Web Login Details</h4>
                    <p class="text-muted">
                        Track login & logout activity of all employees with their exact locations.
                    </p>

                    {{-- Success Message --}}
                    @if(session('message'))
                        <p class="text-success fw-bold">{{ session('message') }}</p>
                    @endif


                    <div class="table-responsive mt-3">

                        <table id="example1" class="table table-bordered table-striped">

                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Employee Email</th>
                                    <th>Login Time</th>
                                    <th>Logout Time</th>
                                    <th>Status</th>
                                    <th>Login Location</th>
                                    <th>Logout Location</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($data as $value)
                                <tr>

                                    <td>{{ $loop->iteration }}</td>

                                    <td>{{ $value->uemail }}</td>

                                    <td>{{ $value->login_time }}</td>

                                    <td>{{ $value->logout_time ?? '--' }}</td>

                                    <td>
                                        <span class="badge badge-{{ $value->current_status == 1 ? 'success' : 'danger' }}">
                                            {{ $value->current_status == 1 ? 'Login' : 'Logout' }}
                                        </span>
                                    </td>

                                    <td>
                                        @if($value->latitude && $value->longitude)
                                            <a href="https://maps.google.com/?q={{ $value->latitude }},{{ $value->longitude }}"
                                               class="badge badge-info p-2"
                                               target="_blank">
                                                View Login Location
                                            </a>
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if($value->logout_lat && $value->logout_long)
                                            <a href="https://maps.google.com/?q={{ $value->logout_lat }},{{ $value->logout_long }}"
                                               class="badge badge-warning p-2"
                                               target="_blank">
                                                View Logout Location
                                            </a>
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </section>

</div>

@endsection



@push('footer-section-code')

<!-- DataTables Scripts -->
<script src="{{url('/')}}/admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{url('/')}}/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{url('/')}}/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{url('/')}}/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<script src="{{url('/')}}/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{url('/')}}/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>

<script src="{{url('/')}}/admin/plugins/jszip/jszip.min.js"></script>
<script src="{{url('/')}}/admin/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{url('/')}}/admin/plugins/pdfmake/vfs_fonts.js"></script>

<script src="{{url('/')}}/admin/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{url('/')}}/admin/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{url('/')}}/admin/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


<!-- INITIALIZE DATATABLE -->
<script>
$(function () {

    $("#example1").DataTable({
        responsive: true,
        autoWidth: false,
        lengthChange: false,
        buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

});
</script>

@endpush
