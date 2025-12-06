@extends('layouts.masteradmin')
@section('body')
 <!-- DataTables -->
  <link rel="stylesheet" href="{{url('/')}}/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{url('/')}}/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{url('/')}}/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<div class="page-content">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">All Admin</h4>
                    <p class="card-title-desc">
                        List of all admins with their essential information & controls.
                    </p>

                    {{-- Success Message --}}
                    @if(session('message'))
                        <p class="text-success fw-bold">{{ session('message') }}</p>
                    @endif

                    <div class="table-responsive mt-3">
                        <table class="table table-bordered table-striped align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Full Name</th>
                                    <th>Mobile Number</th>
                                    <th>Email</th>
                                    <th>Aadhar Number</th>
                                    <th>PAN Number</th>
                                    <th>Date of Joining</th>
                                    <th>Total Leave</th>
                                    <th width="120">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($data as $value)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>{{ $value->fname }}</td>

                                    <td>{{ $value->empmob }}</td>

                                    <td>{{ $value->empmail }}</td>

                                    <td>{{ $value->aadhar_no ?? '--' }}</td>

                                    <td>{{ $value->pan_no ?? '--' }}</td>

                                    <td>{{ $value->doj }}</td>

                                    <td>{{ $value->total_leave }}</td>

                                    <td>
                                        <div class="d-flex gap-2">

                                            <a href="{{ route('admins_edit', $value->id) }}" 
                                               class="btn btn-sm btn-outline-primary">
                                               <i class="bx bx-pencil"></i> Edit
                                            </a>

                                            @if(Auth::user()->type == 'master_admin')
                                            <button class="btn btn-sm btn-outline-danger"
                                                    onclick="deleteAdmin('{{ $value->id }}')">
                                                <i class="bx bx-trash"></i> Delete
                                            </button>
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
    </div>
</div>

@endsection

@push('footer-section-code')

<script>
function deleteAdmin(id) {
    if(confirm('Are you sure you want to delete this Admin?')) {

        $.ajax({
            method: 'POST',
            url: '{{ url("master-admin/admins") }}/' + id,
            data: {
                id: id,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {

                if(response.success) {
                    location.reload();
                    swal("Success!", response.message, "success");
                } else {
                    location.reload();
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
@endpush
