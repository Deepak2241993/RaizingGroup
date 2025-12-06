@extends('layouts.masteradmin')
@section('body')
@push('csslink')
    <!-- DataTables -->
  <link rel="stylesheet" href="{{url('/')}}/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{url('/')}}/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{url('/')}}/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endpush
<div class="content-wrapper">

    <!-- Header -->
    <section class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Admin Leave Information</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Admin Leaves</li>
                    </ol>
                </div>
            </div>

        </div>
    </section>


    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">

            @if(session('message'))
                <p class="text-success font-weight-bold">{{ session('message') }}</p>
            @endif

            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">

                        <table id="example1" class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Admin Name</th>
                                    <th>Leave Subject</th>
                                    <th>Description</th>
                                    <th>Attachment</th>
                                    <th>Leave From</th>
                                    <th>Leave To</th>
                                    <th>Leave Remaining</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($data as $value)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $value->fname . $value->mname . $value->lname }}</td>
                                    <td>{{ $value->l_title }}</td>
                                    <td>{{ $value->l_desc }}</td>
                                    <td>{{ $value->attachment }}</td>
                                    <td>{{ $value->l_date }}</td>
                                    <td>{{ $value->to_date }}</td>
                                    <td>{{ $value->no_days }}</td>

                                    {{-- Status Buttons --}}
                                    @if($value->l_status == 1)
                                        <td><span class="btn btn-primary btn-sm disabled">Leave Approved</span></td>

                                    @elseif($value->l_status == 2)
                                        <td><span class="btn btn-warning btn-sm disabled">Leave Rejected</span></td>

                                    @else
                                        <td>
                                            <button type="button" class="btn btn-success btn-sm"
                                                onclick="approve({{ $value->id }})">
                                                Approve
                                            </button>

                                            <button type="button" class="btn btn-danger btn-sm mt-1"
                                                onclick="reject({{ $value->id }})">
                                                Reject
                                            </button>
                                        </td>
                                    @endif

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
    function approve(id){
        if(confirm('You Want To Approve Leave?')){
            $.ajax({
                method:'POST',
                url: '{{ url('master-admin/AdminLeaveStatusApprove') }}/' + id,
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

    function reject(id){
        if(confirm('Are You Sure You Want To Reject?')){
            $.ajax({
                method:'POST',
                url: '{{ url('master-admin/AdminLeaveStatusReject') }}/' + id,
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

