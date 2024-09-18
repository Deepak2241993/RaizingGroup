@extends('layouts.masteradmin')
@section('body')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Responsive Table</h4>
                <p class="card-title-desc">
                    Create responsive tables by wrapping any <code>.table</code> in <code>.table-responsive</code>
                    to make them scroll horizontally on small devices (under 768px).
                </p>

                <div class="table-responsive">
                   My All Task
                    @if(session('message')) <p style="color:rgb(6, 82, 6); font-weight: 600;">{{session('message')}}</p>@endif
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                              
                                <th>Vendor Name</th>
                                <th>Task</th>
                                <th>Assign Date</th>
                                <th>Deadline Date</th>
                                <th>File</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $value)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$value->vendor_name}}</td>
                                <td>{{$value->task_detail}}</td>
                                <td>{{$value->assign_date}}</td>
                                <td>{{$value->deadline_date}}</td>
                                <td><a href="{{url('/images/'.$value->task_file)}}" target="_blank" download>Download File</a></td>
                                
                                <td><div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                                    {{-- <input class="form-check-input" type="checkbox" id="SwitchCheckSizemd{{$value->id}}" @if($value->status==1){{'checked'}} @endif> --}}
                                    
                                    <label class="form-check-label" for="SwitchCheckSizemd{{$value->id}}">@if($value->status==1)<button class="btn btn-success">Completed</button>@else <button class="btn btn-warning" onClick="update_status('{{$value->id}}')">Incomplete</button> @endif</label>
                                    </div>
                                </td>
                                <td>
                                    <div class="button_align">
                                        <a href="{{route('vendor-task.edit',$value->id)}}" class="btn btn-outline-primary"><i class="bx bx-pencil"></i> Edit </a> 
                                       
                                        @if($usertype=Auth::user()->type =='master_admin')
                                        <a href="javascript:void(0);"  onClick="deletetasks('{{$value->id}}')" class="btn btn-outline-danger"><i class="bx bx-trash-alt"></i> Delete</a>
                                        @endif
                                    </div>
                                </td>
                                
                            </tr>
                            
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{$data->links('vendor.pagination.simple-bootstrap-4')}}
                
            </div>
        </div>
    </div>
</div>
@endsection

@push('footer-section-code')

<script>
    function deletetasks(tid){
        if(confirm('Are You sure'))
        {
        $.ajax({
            method:'DELETE',
            url: '{{ url('master-admin/vendor-task') }}/'+tid,
            data:{
                id: tid,
                _token: '{{ csrf_token() }}'
            },
            success:function(response){
                
                if(response.success==true)
                {
                    location.reload();
                    swal("Success!", response.message, "success");
                    

                }
                if(response.success==false)
                {
                    location.reload();
                    swal("Deleted!", response.message, "error");
                    

                }
                
            }
        });
    }
}
    function update_status(tid){
        if(confirm('Do you want to change status'))
        {
        $.ajax({
            method:'POST',
            url: '{{ url('master-admin/vendor-task/') }}/'+tid,
            data:{
                id: tid,
                _token: '{{ csrf_token() }}'
            },
            success:function(response){
                
                if(response.success)
                {
                    location.reload();
                    swal("Deleted!", "Status is Updated!", "success");

                }
                
            }
        });
    }
}
    </script>


@endpush