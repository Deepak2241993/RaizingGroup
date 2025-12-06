@extends('layouts.masteradmin')
@section('body')
@push('csslink')
    <!-- DataTables -->
  <link rel="stylesheet" href="{{url('/')}}/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{url('/')}}/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{url('/')}}/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endpush
<div class="content-wrapper">

    <!-- PAGE HEADER -->
    <section class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Management Tasks</h1>
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

            @if(session('message'))
                <p class="text-success font-weight-bold">{{ session('message') }}</p>
            @endif

            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">Management Task List</h3>
                </div>

                <div class="card-body">

                    <div class="table-responsive">

                        <table id="example1" class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Reporter</th>
                                    <th>Task Assignee</th>
                                    <th>User Role</th>
                                    <th>Task Title</th>
                                    <th>Assign Date</th>
                                    <th>File</th>
                                    <th>Task Details</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($data as $value)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $value->repoter }}</td>
                                    <td>{{ $value->taskAssigneTo }}</td>

                                    <td>
                                        @if($value->role==0)
                                            Employee
                                        @elseif($value->role==1)
                                            Admin
                                        @elseif($value->role==2)
                                            HR
                                        @endif
                                    </td>

                                    <td>{{ $value->t_title }}</td>
                                    <td>{{ $value->assign_date }}</td>

                                    <td>
                                        @if(!empty($value->t_file))
                                            <a href="{{ url('/images/'.$value->t_file) }}" target="_blank" download>
                                                Download File
                                            </a>
                                        @endif
                                    </td>

                                    <td>{{ $value->t_detail }}</td>

                                    <td>
                                        @if($value->status == 1)
                                            <button class="btn btn-success btn-sm">Completed</button>
                                        @else
                                            <button class="btn btn-warning btn-sm"
                                                    onclick="update_status('{{ $value->id }}')">
                                                Incomplete
                                            </button>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="btn-group">

                                            <a href="{{ route('managementtask.edit', $value->id) }}"
                                               class="btn btn-outline-primary btn-sm">
                                                <i class="bx bx-pencil"></i> Edit
                                            </a>

                                            @if(Auth::user()->type == 'master_admin')
                                            <a href="javascript:void(0);"
                                               onclick="deletetasks('{{ $value->id }}')"
                                               class="btn btn-outline-danger btn-sm">
                                                <i class="bx bx-trash-alt"></i> Delete
                                            </a>
                                            @endif

                                        </div>
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
/* DELETE TASK */
function deletetasks(id){
    if(confirm('Are you sure you want to delete this task?')){
        $.ajax({
            method:'DELETE',
            url: '{{ url('master-admin/managementtask') }}/'+id,
            data:{
                id:id,
                _token:'{{ csrf_token() }}'
            },
            success:function(response){
                location.reload();
                swal("Success!", response.message, "success");
            }
        });
    }
}


/* UPDATE STATUS */
function update_status(id){
    if(confirm('Do you want to change task status?')){
        $.ajax({
            method:'POST',
            url: '{{ url('master-admin/managementtask') }}/'+id,
            data:{
                id:id,
                _token:'{{ csrf_token() }}'
            },
            success:function(response){
                if(response.success){
                    location.reload();
                    swal("Success!", "Status Updated Successfully!", "success");
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
