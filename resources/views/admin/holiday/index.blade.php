@extends('layouts.masteradmin')
@section('body')
@push('csslink')
    <!-- DataTables -->
  <link rel="stylesheet" href="{{url('/')}}/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{url('/')}}/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{url('/')}}/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endpush
<div class="content-wrapper">

    <!-- Content Header -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">

          <div class="col-sm-6">
            <h1>Employee Holidays List (Company Wise)</h1>
          </div>

          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/master-admin/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Holidays</li>
            </ol>
          </div>

        </div>
      </div>
    </section>

    <!-- Main Body Content -->
    <section class="content">

        <div class="container-fluid">

            <div class="card">

                <div class="card-body">

                    {{-- Success Message --}}
                    @if(session('message')) 
                        <p class="text-success fw-bold">{{ session('message') }}</p>
                    @endif

                    <div class="table-responsive mt-3">

                        <h5 class="mb-3">Employee's Holidays List Company Wise</h5>

                        <table id="example1" class="table table-bordered table-striped">

                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Company Name</th>
                                    <th>Brand Name</th>
                                    <th>View</th>

                                    @if(
                                        $usertype = Auth::user()->type == 'master_admin' || 
                                        $usertype = Auth::user()->type == 'HR' || 
                                        $usertype = Auth::user()->type == 'Admin'
                                    )
                                        <th>Action</th>
                                    @endif
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($data as $value)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $value->company_name }}</td>
                                    <td>{{ $value->brand }}</td>

                                    <td>
                                        <a href="{{ route('viewholidays', ['id'=>$value->id]) }}" 
                                           class="btn btn-primary btn-sm">
                                            View Holidays
                                        </a>
                                    </td>

                                    {{-- ACTION COLUMN --}}
                                    @if(
                                        $usertype = Auth::user()->type == 'master_admin' ||
                                        $usertype = Auth::user()->type == 'HR' ||
                                        $usertype = Auth::user()->type == 'Admin'
                                    )
                                    <td>
                                        <div class="d-flex gap-2">

                                            <a href="{{ route('holiday.edit', $value->id) }}" 
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

                                        </div>
                                    </td>
                                    @endif

                                </tr>
                                @endforeach
                            </tbody>

                        </table>

                    </div>

                    {{-- Pagination --}}
                    

                </div>

            </div>

        </div>

    </section>

</div>

@endsection



@push('footer-section-code')

<script>
function deleteblogs(tid){
    if(confirm('Are You sure')) {
        $.ajax({
            method:'DELETE',
            url: '{{ url('master-admin/holiday') }}/'+tid,
            data:{
                id: tid,
                _token: '{{ csrf_token() }}'
            },
            success:function(response){
                
                if(response.success==true){
                    location.reload();
                    swal("Success!", response.message, "success");
                }

                if(response.success==false){
                    location.reload();
                    swal("Deleted!", response.message, "error");
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

