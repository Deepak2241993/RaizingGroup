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
                    <h1>All Vendors</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Vendor List</li>
                    </ol>
                </div>

            </div>

        </div>
    </section>


    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">

            @if(session('message'))
                <div class="alert alert-success font-weight-bold">
                    {{ session('message') }}
                </div>
            @endif

            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">

                        <table id="example1" class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Vendor Name</th>
                                    <th>Brand Name</th>
                                    <th>Contact</th>
                                    <th>Email</th>
                                    <th>Service</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($data as $value)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $value->fname }} {{ $value->mname }} {{ $value->lname }}</td>
                                    <td>{{ $value->bname }}</td>
                                    <td>{{ $value->vcont }}</td>
                                    <td>{{ $value->vemail }}</td>
                                    <td>{{ $value->vservice }}</td>

                                    <td>
                                        <a href="{{ route('vendor.edit', $value->id) }}"
                                            class="btn btn-primary btn-sm">
                                            <i class="bx bx-pencil"></i> Edit
                                        </a>

                                        @if(Auth::user()->type == 'master_admin')
                                            <button class="btn btn-danger btn-sm"
                                                    onclick="deleteVendor({{ $value->id }})">
                                                <i class="bx bx-trash-alt"></i> Delete
                                            </button>
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

<script>
function deleteVendor(id){
    if(confirm('Are you sure you want to delete this vendor?')){
        $.ajax({
            method: 'DELETE',
            url: '{{ url("master-admin/vendor") }}/' + id,
            data: {
                id: id,
                _token: '{{ csrf_token() }}'
            },
            success: function(response){

                if(response.success){
                    swal("Success!", response.message, "success");
                } else {
                    swal("Error!", response.message, "error");
                }

                location.reload();
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

