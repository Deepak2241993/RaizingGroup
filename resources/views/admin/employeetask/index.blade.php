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
                    <h1>Employee All Tasks</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('master-dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Employee Tasks</li>
                    </ol>
                </div>

            </div>

        </div>
    </section>

    <!-- Main Body -->
    <section class="content">
        <div class="container-fluid">

            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">List of Tasks assigned to all Employees</h3>
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
                                    <th>Task Title</th>
                                    <th>Assign Date</th>
                                    <th>File</th>
                                    <th>Task Details</th>
                                    <th>Status</th>
                                    @if(Auth::user()->type == 'master_admin')
                                        <th>Action</th>
                                    @endif
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($data as $value)
                                <tr>

                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $value->emp_name }}</td>
                                    <td>{{ $value->t_title }}</td>
                                    <td>{{ $value->assign_date }}</td>

                                    <td>
                                        @if(!empty($value->t_file))
                                            <a href="{{ url('/images/'.$value->t_file) }}"
                                               target="_blank" download>
                                                Download File
                                            </a>
                                        @endif
                                    </td>

                                    <td>{{ $value->t_detail }}</td>

                                    <td>
                                        <span class="btn btn-sm 
                                            @if($value->status=='0') btn-danger 
                                            @elseif($value->status=='2') btn-warning
                                            @else btn-success @endif">
                                            @if($value->status=='0') To Do
                                            @elseif($value->status=='2') In Progress
                                            @else Completed
                                            @endif
                                        </span>
                                    </td>

                                    @if(Auth::user()->type=='master_admin')
                                    <td>
                                        <a href="{{ route('employeetask.edit', $value->id) }}"
                                           class="btn btn-outline-primary btn-sm">
                                            <i class="bx bx-pencil"></i> View Task
                                        </a>

                                        <a href="javascript:void(0);"
                                           onclick="deletetasks('{{ $value->id }}')"
                                           class="btn btn-outline-danger btn-sm">
                                            <i class="bx bx-trash-alt"></i> Delete
                                        </a>
                                    </td>
                                    @endif

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

<!-- DELETE TASK -->
<script>
function deletetasks(id){
    if(confirm("Are you sure you want to delete this task?")){

        $.ajax({
            url: '{{ url("master-admin/employeetask") }}/' + id,
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


<!-- UPDATE STATUS -->
<script>
function update_status(id){
    if(confirm("Do you want to change status?")){

        $.ajax({
            url: '{{ url("master-admin/employee_task_update") }}/' + id,
            type: 'POST',
            data: {
                id: id,
                _token: '{{ csrf_token() }}'
            },
            success:function(response){
                if(response.success){
                    swal("Success!", "Status Updated Successfully", "success");
                    location.reload();
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
@endpush

