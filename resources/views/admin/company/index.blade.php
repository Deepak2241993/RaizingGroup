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
            <h1>All Companies</h1>
          </div>

          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('master-dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Companies</li>
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
            <h3 class="card-title">Company List</h3>
          </div>

          <div class="card-body">

            <div class="table-responsive">

                @if(session('message'))
                    <p class="text-success font-weight-bold">{{ session('message') }}</p>
                @endif

                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Company Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Website</th>
                            <th>Add Brand</th>
                            <th>View Brand</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($data as $value)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $value->compname }}</td>
                            <td>{{ $value->compemail }}</td>
                            <td>{{ $value->compmob }}</td>
                            <td>{{ $value->web_link }}</td>

                            <td>
                                <a href="{{ route('brands.create', ['company' => $value->id]) }}"
                                   class="btn btn-primary btn-sm">
                                    Add Brand
                                </a>
                            </td>

                            <td>
                                <a href="{{ route('company.show', ['company' => $value->id]) }}"
                                   class="btn btn-dark btn-sm">
                                    View Brands 
                                    {{ \App\Models\Brand::where('bcomp', $value->id)->count() }}
                                </a>
                            </td>

                            <td>
                                <a href="{{ route('company.edit', $value->id) }}" 
                                   class="btn btn-outline-primary btn-sm">
                                    <i class="bx bx-pencil"></i> Edit
                                </a>

                                <a href="javascript:void(0);" 
                                   onclick="deleteCompany('{{ $value->id }}')" 
                                   class="btn btn-outline-danger btn-sm">
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
function deleteCompany(id) {
    if (confirm('Are you sure you want to delete this company?')) {

        $.ajax({
            url: '{{ url("master-admin/company") }}/' + id,
            type: 'DELETE',
            data: {
                id: id,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {

                if (response.success) {
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
@endpush
