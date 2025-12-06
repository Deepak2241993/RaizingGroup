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
            <h1>My All Tasks</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('master-dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">My Tasks</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Page Content -->
    <section class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Responsive Table</h3>
                </div>

                <div class="card-body">

                    <div class="table-responsive">
                        <h5>My All Task</h5>

                        @if(session('message'))
                            <p style="color:rgb(6, 82, 6); font-weight:600;">{{ session('message') }}</p>
                        @endif

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Brand Name</th>
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
                                    <td>{{ $value->brand_name }}</td>
                                    <td>{{ $value->t_title }}</td>
                                    <td>{{ $value->assign_date }}</td>
                                    <td>
                                        <a href="{{ url('/images/'.$value->t_file) }}" target="_blank">
                                            {{ $value->t_file }}
                                        </a>
                                    </td>
                                    <td>{{ $value->t_detail }}</td>

                                    <td>
                                        @if($value->status == 1)
                                            <button class="btn btn-success btn-sm">Completed</button>
                                        @else
                                            <button class="btn btn-warning btn-sm" onclick="update_status('{{ $value->id }}')">
                                                Incomplete
                                            </button>
                                        @endif
                                    </td>

                                    <td>
                                        <a href="{{ route('tasks.edit', $value->id) }}" class="text-primary">
                                            <i class="bx bx-pencil"></i> Edit
                                        </a>
                                         |
                                        <a href="javascript:void(0);" onclick="deletetasks('{{ $value->id }}')" class="text-danger">
                                            <i class="bx bx-trash-alt"></i> Delete
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

    function deletetasks(tid){
        if(confirm('Are you sure you want to delete?'))
        {
            $.ajax({
                method:'DELETE',
                url: '{{ url('master-admin/tasks') }}/' + tid,
                data:{
                    id: tid,
                    _token: '{{ csrf_token() }}'
                },
                success:function(response){
                    if(response.success){
                        location.reload();
                        swal("Success!", response.message, "success");
                    }else{
                        swal("Error!", response.message, "error");
                    }
                }
            });
        }
    }

    function update_status(tid){
        if(confirm('Do you want to change status?'))
        {
            $.ajax({
                method:'POST',
                url: '{{ url('master-admin/statusUpdate') }}/' + tid,
                data:{
                    id: tid,
                    _token: '{{ csrf_token() }}'
                },
                success:function(response){
                    if(response.success){
                        location.reload();
                        swal("Success!", "Status updated successfully!", "success");
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
