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
                    <h1>All Customer Queries</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('master-dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Customer Queries</li>
                    </ol>
                </div>

            </div>

        </div>
    </section>


    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">

            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">Customer Query List</h3>
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
                                    <th>Lead Type</th>
                                    <th>Assign Task</th>
                                    <th>Added By</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Contact</th>
                                    <th>Passport No.</th>
                                    <th>Query</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>

                            @foreach($data as $key => $value)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $value->leadtype }}</td>

                                    <!-- Assign Task Modal Button -->
                                    <td>
                                        <button class="btn btn-primary btn-sm"
                                                data-toggle="modal"
                                                data-target="#assign_task_{{ $key }}">
                                            Assign Task
                                        </button>
                                        
                                    </td>

                                    <td>{{ $value->created_by }}</td>
                                    <td>{{ $value->ct_name }}</td>
                                    <td>{{ $value->ct_mail }}</td>
                                    <td>{{ $value->ct_mob }}</td>
                                    <td>{{ $value->ct_passport }}</td>
                                    <td>{{ $value->query_details }}</td>

                                    <td>
                                        <a href="{{ route('customer-query.edit', $value->id) }}"
                                           class="btn btn-outline-primary btn-sm">
                                            <i class="bx bx-pencil"></i> Edit
                                        </a>

                                        @if(Auth::user()->type == 'master_admin')
                                            <a href="javascript:void(0);"
                                               onclick="deleteblogs('{{ $value->id }}')"
                                               class="btn btn-outline-danger btn-sm">
                                                <i class="bx bx-trash-alt"></i> Delete
                                            </a>
                                        @endif
                                    </td>
                                </tr>


                                <!-- Assign Task Modal -->
                                <div class="modal fade" id="assign_task_{{ $key }}" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title">Assign Query As Task</h5>
                                                <button type="button" class="close"
                                                        data-dismiss="modal">X</button>
                                            </div>

                                            <div class="modal-body">

                                                <form action="{{ route('employeetask.store') }}"
                                                      method="POST"
                                                      enctype="multipart/form-data">
                                                    @csrf

                                                    <div class="row">

                                                        <!-- Employee Select -->
                                                        <div class="col-md-6 mb-3">
                                                            <label>Employee <span class="text-danger">*</span></label>
                                                            <select class="form-control selectpicker"
                                                                    name="emp_id"
                                                                    data-live-search="true" required>
                                                                <option value="">Select Employee</option>
                                                                @foreach($employees as $e)
                                                                    <option value="{{ $e->id }}">{{ $e->fname }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <!-- Task Title -->
                                                        <div class="col-md-6 mb-3">
                                                            <label>Task Title</label>
                                                            <input type="text" class="form-control"
                                                                   name="t_title" value="Assign Query" required>
                                                        </div>

                                                        <!-- Deadline -->
                                                        <div class="col-md-6 mb-3">
                                                            <label>Deadline</label>
                                                            <input type="date" class="form-control" name="deadline" required>
                                                        </div>

                                                        <!-- Files -->
                                                        <div class="col-md-6 mb-3">
                                                            <label>Upload Files</label>
                                                            <input type="file" name="t_file" multiple class="form-control">
                                                        </div>

                                                        <!-- Task Detail -->
                                                        <div class="col-md-12 mb-3">
                                                            <label>Task Detail</label>
                                                            <textarea class="form-control" name="t_detail"
                                                                      rows="4">{{ $value->query_details }}</textarea>
                                                        </div>

                                                    </div>

                                                    <button class="btn btn-primary">Submit</button>

                                                </form>

                                            </div>

                                        </div>
                                    </div>
                                </div>

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

<!-- Bootstrap Select -->
<link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">

<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>

<script>
    $(document).ready(function () {
        $('.selectpicker').selectpicker();
    });
</script>

<script>
function deleteblogs(id) {
    if (confirm('Are you sure you want to delete this query?')) {

        $.ajax({
            url: '{{ url("master-admin/customer-query") }}/' + id,
            type: 'DELETE',
            data: {
                id: id,
                _token: '{{ csrf_token() }}'
            },
            success: function (res) {
                if(res.success){
                    swal("Success!", res.message, "success");
                    location.reload();
                } else {
                    swal("Error!", res.message, "error");
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

