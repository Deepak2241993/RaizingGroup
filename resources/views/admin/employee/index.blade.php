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
                    <h1>All Employees</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('master-dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Employee List</li>
                    </ol>
                </div>

            </div>

        </div>
    </section>

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">

            <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Employee Records</h3>

                    @if(Auth::user()->type != 'Employee')
                        <a href="{{ route('employee.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Add Employee
                        </a>
                    @endif
                </div>

                <div class="card-body">

                    @if(session('message'))
                        <p class="text-success font-weight-bold">{{ session('message') }}</p>
                    @endif

                    <div class="table-responsive">

                        <table id="example1" class="table table-bordered table-striped">

                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Employee Name</th>
                                    <th>Brand Name</th>
                                    <th>Designation</th>
                                    <th>Location</th>
                                    <th>Contact</th>
                                    <th>Role</th>
                                    <th>Assign Task</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach($data as $value)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>{{ $value->fname . ' ' . $value->mname . ' ' . $value->lname }}</td>

                                    <td>{{ $value->bname }}</td>

                                    <td>{{ $value->designation }}</td>

                                    <td>{{ $value->eloc }}</td>

                                    <td>{{ $value->empmob }}</td>

                                    <td>
                                        @if($value->role == 0)
                                            <button class="btn btn-primary btn-sm" disabled>Employee</button>
                                        @elseif($value->role == 1)
                                            <button class="btn btn-success btn-sm" disabled>Admin</button>
                                        @else
                                            <button class="btn btn-dark btn-sm" disabled>HR</button>
                                        @endif
                                    </td>

                                    <td>
                                        <a class="btn btn-primary btn-sm"
                                           href="{{ route('employeetask.create',['id'=>$value->id]) }}">
                                            Assign Task
                                        </a>
                                    </td>

                                    <td>
                                        <a href="{{ route('employee.edit',$value->id) }}"
                                           class="btn btn-outline-primary btn-sm">
                                            <i class="bx bx-pencil"></i> Edit
                                        </a>

                                        @if(Auth::user()->type == 'master_admin')
                                            <a href="javascript:void(0);"
                                               onclick="deleteEmployee('{{ $value->id }}')"
                                               class="btn btn-outline-danger btn-sm">
                                                <i class="bx bx-trash-alt"></i> Delete
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>

                        </table>

                    </div>

                    <!-- Pagination -->
                    

                </div>

            </div>

        </div>
    </section>

</div>

@endsection



@push('footer-section-code')

<script>
function deleteEmployee(id){
    if(confirm("Are you sure you want to delete this employee?")){

        $.ajax({
            url: '{{ url("master-admin/employee") }}/' + id,
            type: 'DELETE',
            data: {
                id: id,
                _token: '{{ csrf_token() }}'
            },

            success:function(response){

                if(response.success){
                    swal("Success!", response.message, "success");
                    location.reload();
                } else {
                    swal("Error!", response.message, "error");
                }

            }
        });

    }
}
</script>
<!-- DataTables  & Plugins -->
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

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<!-- DataTables  & Plugins -->
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

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
@endpush


