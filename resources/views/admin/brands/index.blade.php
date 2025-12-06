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
                    <h1>Company Brands</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('company.index') }}">Company</a></li>
                        <li class="breadcrumb-item active">Brand List</li>
                    </ol>
                </div>
            </div>

        </div>
    </section>


    <!-- Main Section -->
    <section class="content">
        <div class="container-fluid">

            <a href="{{ route('company.index') }}" class="btn btn-primary mb-3">
                <i class="fas fa-arrow-left"></i> Back
            </a>

            @if(session('message'))
                <p class="text-success font-weight-bold">{{ session('message') }}</p>
            @endif


            <div class="card">

                <div class="card-header bg-dark text-white">
                    <h3 class="card-title">Brand List</h3>
                </div>

                <div class="card-body">
                    <div class="table-responsive">

                        <table id="example1" class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Brand Name</th>
                                    <th>Company Name</th>
                                    <th>Division</th>
                                    <th>Email</th>
                                    <th>Contact</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($data as $value)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $value->bname }}</td>
                                    <td>{{ $value->comp_name }}</td>
                                    <td>{{ $value->bdivision }}</td>
                                    <td>{{ $value->div_mail }}</td>
                                    <td>{{ $value->div_mob }}</td>

                                    <td>
                                        <a href="{{ route('brands.edit', $value->id) }}"
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>

                                        @if(Auth::user()->type == 'master_admin')
                                        <button class="btn btn-sm btn-outline-danger"
                                                onclick="deleteBrand('{{ $value->id }}')">
                                            <i class="fas fa-trash-alt"></i> Delete
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
    function deleteBrand(id){

        if(confirm('Are you sure you want to delete this brand?')){
            $.ajax({
                method: 'DELETE',
                url: '{{ url('master-admin/brands') }}/' + id,
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {

                    if(response.success){
                        swal("Success!", response.message, "success");
                        setTimeout(() => location.reload(), 1200);
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
