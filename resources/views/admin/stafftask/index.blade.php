@extends('layouts.masteradmin')
@section('body')
@push('csslink')
    <!-- DataTables -->
  <link rel="stylesheet" href="{{url('/')}}/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{url('/')}}/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{url('/')}}/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endpush
<div class="content-wrapper">

    <!-- HEADER -->
    <section class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1>Management Task List</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Management Tasks</li>
                    </ol>
                </div>

            </div>

        </div>
    </section>


    <!-- MAIN CONTENT -->
    <section class="content">
        <div class="container-fluid">

            @if (session('message'))
                <p class="text-success font-weight-bold">{{ session('message') }}</p>
            @endif


            <!-- TAB SECTION -->
            <ul class="nav nav-tabs mb-4">

                <li class="nav-item">
                    <a class="nav-link active" id="me_task_button"
                       onclick="tabFunction('task_assign_by_me')"
                       href="javascript:void(0)">
                       Task Assigned By Me
                    </a>
                </li>

                @if(Auth::user()->type!='Employee')
                <li class="nav-item">
                    <a class="nav-link" id="my_task_tab"
                       onclick="tabFunction('mytask')"
                       href="javascript:void(0)">
                       My Tasks
                    </a>
                </li>
                @endif

            </ul>


            <!-- ===================== My Tasks ===================== -->
            @if(Auth::user()->type!='Employee')
            <div id="mytask" style="display: none">

                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h3 class="card-title">Management — My Tasks</h3>
                    </div>

                    <div class="card-body table-responsive">

                        <table id="example1" class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Task Assign By</th>
                                    <th>Task Assign To</th>
                                    <th>Task Title</th>
                                    <th>Assign Date</th>
                                    <th>File</th>
                                    <th>Details</th>
                                    <th>Status</th>
                                    @if(Auth::user()->type=='master_admin')
                                        <th>Action</th>
                                    @endif
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($task_for_me as $value)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $value->assigner_name }}</td>
                                    <td>{{ $value->assignee_name }}</td>
                                    <td>{{ $value->t_title }}</td>
                                    <td>{{ $value->assign_date }}</td>
                                    <td>
                                        <a href="{{ url('/images/'.$value->t_file) }}"
                                           target="_blank"
                                           download>Download</a>
                                    </td>
                                    <td>{{ $value->t_detail }}</td>

                                    <!-- STATUS -->
                                    <td>
                                        <button class="btn btn-
                                            @if($value->status == 0) danger
                                            @elseif($value->status == 2) warning
                                            @else success @endif
                                            btn-sm">
                                            @if($value->status==0) To Do
                                            @elseif($value->status==2) In Progress
                                            @else Completed
                                            @endif
                                        </button>
                                    </td>

                                    <!-- ACTION -->
                                    @if(Auth::user()->type=='master_admin')
                                    <td>
                                        <a href="{{ route('managementtask.edit',$value->id) }}"
                                           class="btn btn-primary btn-sm">
                                           Edit
                                        </a>

                                        <a href="javascript:void(0)"
                                           onclick="deletetasks('{{ $value->id }}')"
                                           class="btn btn-danger btn-sm">
                                           Delete
                                        </a>
                                    </td>
                                    @endif

                                </tr>
                                @endforeach
                            </tbody>
                        </table>


                    </div>
                </div>

            </div>
            @endif





            <!-- ===================== Task Assigned By Me ===================== -->
            <div id="task_assign_by_me">

                <div class="d-flex justify-content-between mb-3">
                    <h4>Tasks I Assigned</h4>
                    <a href="{{ route('managementtask.create') }}" class="btn btn-primary">Add Task</a>
                </div>

                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">Task Assigned By Me</h3>
                    </div>

                    <div class="card-body table-responsive">

                        <table id="example1" class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Task Assign By</th>
                                    <th>Task Assign To</th>
                                    <th>Task Title</th>
                                    <th>Assign Date</th>
                                    <th>File</th>
                                    <th>Details</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($task_assign_by_me as $value)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $value->assigner_name }}</td>
                                    <td>{{ $value->assignee_name }}</td>
                                    <td>{{ $value->t_title }}</td>
                                    <td>{{ $value->assign_date }}</td>
                                    <td>
                                        <a href="{{ url('/images/'.$value->t_file) }}"
                                           target="_blank" download>
                                            Download
                                        </a>
                                    </td>
                                    <td>{{ $value->t_detail }}</td>

                                    <td>
                                        <button class="btn btn-
                                            @if($value->status == 0) danger
                                            @elseif($value->status == 2) warning
                                            @else success @endif
                                            btn-sm">
                                            @if($value->status==0) To Do
                                            @elseif($value->status==2) In Progress
                                            @else Completed
                                            @endif
                                        </button>
                                    </td>

                                    <td>
                                        <a href="{{ route('managementtask.edit',$value->id) }}"
                                           class="btn btn-primary btn-sm">
                                           Edit
                                        </a>

                                        <a href="javascript:void(0)"
                                           onclick="deletetasks('{{ $value->id }}')"
                                           class="btn btn-danger btn-sm">
                                           Delete
                                        </a>
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

<script>
function deletetasks(id){
    if(confirm("Are you sure you want to delete this task?")){
        $.ajax({
            method: 'DELETE',
            url: '{{ url('master-admin/managementtask') }}/' + id,
            data:{
                id: id,
                _token: '{{ csrf_token() }}'
            },
            success: function(response){
                swal("Success!", response.message, "success");
                location.reload();
            }
        });
    }
}

// TAB FUNCTION
function tabFunction(type) {
    if (type === 'mytask') {
        $('#mytask').show();
        $('#task_assign_by_me').hide();
        $('#my_task_tab').addClass('active');
        $('#me_task_button').removeClass('active');
    } else {
        $('#mytask').hide();
        $('#task_assign_by_me').show();
        $('#me_task_button').addClass('active');
        $('#my_task_tab').removeClass('active');
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

