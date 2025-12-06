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
                    <h1>Employee Leave Information</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('master-admin/dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Leave Information</li>
                    </ol>
                </div>

            </div>

        </div>
    </section>


    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">


            @if(session('message'))
                <p class="alert alert-success">{{ session('message') }}</p>
            @endif


            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Employee Leave List</h3>
                </div>

                <div class="card-body table-responsive">

                    <table class="table table-bordered table-hover">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Employee Name</th>
                                <th>Leave Subject</th>
                                <th>Description</th>
                                <th>Attachment</th>
                                <th>Leave From</th>
                                <th>Leave To</th>
                                <th>Remaining Leave</th>
                                <th>Status</th>
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
                                <td>{{ $value->leave_remaining }}</td>

                                {{-- Master Admin Section --}}
                                @if(Auth::user()->type=='master_admin')

                                    @if($value->management_id==0 && $value->l_status==0)
                                        <td>
                                            <button class="btn btn-primary" data-toggle="modal" data-target="#modal_button{{$value->id}}">Approve</button>
                                            <button class="btn btn-danger" data-toggle="modal" data-target="#modal_button{{$value->id}}">Reject</button>
                                        </td>
                    
                                    @endif

                                    @if($value->l_status == 1)
                                        <td><button class="btn btn-primary btn-sm disabled">Leave Approved</button></td>
                                    @endif

                                    @if($value->l_status == 2)
                                        <td><button class="btn btn-warning btn-sm disabled">Leave Rejected</button></td>
                                    @endif


                                {{-- HR / Admin Section --}}
                                @elseif(Auth::user()->type=='Admin' || Auth::user()->type=='HR')

                                    @if($value->management_id == 1 && $value->l_status == 1)
                                        <td><button class="btn btn-primary btn-sm disabled">Leave Approved</button></td>
                                    @endif

                                    @if($value->l_status == 2)
                                        <td><button class="btn btn-warning btn-sm disabled">Leave Rejected</button></td>
                                    @endif

                                    @if($value->management_id==0 && $value->l_status == 0)
                                        <td>
                                            <button class="btn btn-primary" data-toggle="modal" data-target="#modal_button{{$value->id}}">Approve</button>
                                            <button class="btn btn-danger" data-toggle="modal" data-target="#modal_button{{$value->id}}">Reject</button>
                                        </td>
                                    @endif

                                {{-- Employee Section --}}
                                @else

                                    @if($value->l_status == 1)
                                        <td><button class="btn btn-success btn-sm disabled">Approved</button></td>
                                    @endif

                                    @if($value->l_status == 2)
                                        <td><button class="btn btn-warning btn-sm disabled">Rejected</button></td>
                                    @endif

                                    @if($value->l_status == 0)
                                        <td><button class="btn btn-primary btn-sm disabled">Pending</button></td>
                                    @endif

                                @endif


                                <!-- Modal -->
                                <div class="modal fade" id="modal_button{{$value->id}}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">HR/Admin Comment</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form method="post" action="{{ route('primary_leave_status') }}">
                @csrf

                <div class="modal-body">

                    <label class="form-control-label">Comments<span class="text-danger">*</span></label>
                    <textarea class="form-control" name="admin_hr_comments" rows="4">{{ $value->admin_hr_comments ?? '' }}</textarea>

                    <input type="hidden" name="id" value="{{ $value->id }}">
                    <input type="hidden" name="management_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="approved_by" value="{{ Auth::user()->type == 'HR' ? 'HR' : ucfirst(str_replace('_',' ', Auth::user()->type)) }}">


                    <label class="form-control-label mt-3">Leave Status<span class="text-danger">*</span></label>

                    <select class="form-control" name="l_status">
                        <option value="1" @if($value->l_status==1) selected @endif>Approve</option>
                        <option value="2" @if($value->l_status==2) selected @endif>Reject</option>
                    </select>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>

            </form>

        </div>
    </div>
</div>


                            </tr>
                            @endforeach

                        </tbody>

                    </table>

                    

                </div>
            </div>

        </div>
    </section>

</div>

@endsection



@push('footer-section-code')

<script>
function approve(tid){
    if(confirm('You Want To Approve Leave')){
        $.ajax({
            method:'POST',
            url: '{{ url("master-admin/EmpLeaveStatusApprove") }}/'+tid,
            data:{ id: tid, _token:'{{ csrf_token() }}' },
            success:function(response){
                swal("Success!", response.message, "success");
                location.reload();
            }
        });
    }
}

function reject(tid){
    if(confirm('Are You sure you want to Reject')){
        $.ajax({
            method:'POST',
            url: '{{ url("master-admin/EmpLeaveStatusReject") }}/'+tid,
            data:{ id: tid, _token:'{{ csrf_token() }}' },
            success:function(response){
                swal("Success!", response.message, "success");
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

