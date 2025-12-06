@extends('layouts.masteradmin')
@section('body')
@push('csslink')
    <!-- DataTables -->
  <link rel="stylesheet" href="{{url('/')}}/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{url('/')}}/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{url('/')}}/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endpush
<div class="page-content">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">{{ $page_title }}</h4>
                    <p class="card-title-desc">
                        Manage your website settings. Only one settings record is allowed.
                    </p>

                    {{-- Success Message --}}
                    @if(session('message'))
                        <p class="text-success fw-bold">{{ session('message') }}</p>
                    @endif

                    <div class="table-responsive mt-3">
                        <table class="table table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Website Name</th>
                                    <th>Logo</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($datas as $value)
                                    @if($value->id == 1)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $value->web_name }}</td>

                                        <td>
                                            <img src="{{ url('/images/settings/'.$value->web_logo) }}" 
                                                 alt="{{ $value->web_logo }}" 
                                                 style="height: 80px;" 
                                                 class="img-thumbnail">
                                        </td>

                                        <td>
                                            <a href="{{ route('settings.edit', $value->id) }}" 
                                               class="btn btn-outline-primary btn-sm">
                                                <i class="bx bx-pencil"></i> Edit
                                            </a>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-3">
                        {{ $datas->links('vendor.pagination.simple-bootstrap-4') }}
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection


@push('footer-section-code')
<script>
function deletepages(tid){
    if(confirm('Are You sure?')) {
        $.ajax({
            method:'DELETE',
            url: '{{ url('admin/settings') }}/' + tid,
            data:{
                id: tid,
                _token: '{{ csrf_token() }}'
            },
            success:function(response){
                if(response.success){
                    location.reload();
                    swal("Deleted!", "Data Deleted Successfully!", "error");
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

