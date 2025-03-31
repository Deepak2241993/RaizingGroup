@extends('layouts.masteradmin')
@section('body')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive" style="margin-top:80px;">
                   All Cutomer Query
                    @if(session('message')) <p style="color:rgb(6, 82, 6); font-weight: 600;">{{session('message')}}</p>@endif
                    <table class="table mb-0">
                        
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Lead Type</th>
                                <th>Assign To Employee</th>
                                <th>Added By</th>
                                <th>Customer Name</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Passport Number</th>
                                <th>Query</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $key=>$value)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$value->leadtype}}</td>
                                <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#assign_tak_{{$key}}">
                                    Assign Task
                                  </button></td>
                                <td>{{$value->created_by}}</td>
                                <td>{{$value->ct_name}}</td>
                                <td>{{$value->ct_mail}}</td>
                                <td>{{$value->ct_mob}}</td>
                                <td>{{$value->ct_passport}}</td>
                                <td>{{$value->query_details}}</td>
                               
                                <td>
                                    <div class="button_align">
                                        <a href="{{route('customer-query.edit',$value->id)}}" class="btn btn-outline-primary"><i class="bx bx-pencil"></i> Edit </a> 
                                       
                                        @if($usertype=Auth::user()->type =='master_admin')
                                        <a href="javascript:void(0);"  onClick="deleteblogs('{{$value->id}}')" class="btn btn-outline-danger"><i class="bx bx-trash-alt"></i> Delete</a>
                                        @endif
                                    </div>
                                </td>
                                
                            </tr>
                         <!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="assign_tak_{{$key}}" tabindex="-1" aria-labelledby="assign_tak_{{$key}}Label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="assign_tak_{{$key}}Label">Assign Query As Task</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{route('employeetask.store')}}" method="post" enctype="multipart/form-data">
                @csrf
            <div class="card-body card-block">
                <div class="form-group mb-4">
                    <label for="emp_id" class=" form-control-label">Employee Name<span class="text-danger">*</span></label>


                    <select class="form-control selectpicker" id="select-country" name="emp_id" data-live-search="true" required>
                        <option value="">Select Employee</option>
                        @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}" data-tokens="{{ $employee->fname }}">{{ $employee->fname }}</option>
                                @endforeach
                        </select>
                    
                   
                </div>

              <div class="form-group mb-4">
                  <label class="form-control-label">Task Title<span class="text-danger">*</span></label>
                  <input type="text" id="t_title" class="form-control" name="t_title" value="Assign Query" required>
              </div>
              <div class="form-group mb-4">
                <label class="form-control-label">Deadline<span class="text-danger">*</span></label>
                <input type="date" id="deadline" class="form-control" name="deadline" value="{{isset($employeeTask)?$employeeTask->deadline:''}}" required>
            </div>

              <div class="form-group mb-4">
                  <label>Upload task related documents/images (if any)</label>
                  @if(isset($employeeTask))
                  <a href="{{url('/images/'.$employeeTask->t_file)}}">Task File</a>
                  @endif
                  <input type="file" name="t_file" multiple="multiple" class="form-control">
              </div>
              <div class="form-group mb-4">
                  <label for="tdetail" class="form-control-label">Task Detail</label>
                  <textarea name="t_detail" id="t_detail" rows="5" placeholder="Detail..." class="form-control">{{$value->query_details}}</textarea>
              </div>
              @if(isset($employeeTask))
              <div class="form-group mb-4">
                  <label for="comments" class="form-control-label">Comments</label>
                  <textarea name="comments" id="comments" rows="5" placeholder="Comments..." class="form-control">{{isset($employeeTask)?$employeeTask->comments:''}}</textarea>
              </div>
              <div class="form-group mb-4">
                  <label for="tdetail" class="form-control-label">Task Status</label>
                  <select class="form-select" name="status">
                      <option @if(isset($employeeTask) && $employeeTask->status=='0') selected="selected" @endif value="0">To Do</option>
                      <option @if(isset($employeeTask) && $employeeTask->status=='2') selected="selected" @endif value="2">In Progress</option>
                      <option @if(isset($employeeTask) && $employeeTask->status=='1') selected="selected" @endif value="1">Completed</option>
                  </select>
              </div>
              @endif
              <div class="form-group mb-4">
                <input type="submit" name="cok" value="{{isset($employeeTask)?'Update':'Submit'}}" class="form-control btn btn-primary" id="Add_comp_submit" Name="Submit" style="margin-top: 15px; border-radius: 6px; width: 130px;"/>
              </div>
            </div>
        </form>
        </div>
      </div>
    </div>
  </div>
  
  
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
<!-- Include Bootstrap and Bootstrap Select -->
<!-- Add Bootstrap Select CSS and JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>

<!-- Initialize Selectpicker -->
<script>
    $(document).ready(function() {
        $('.selectpicker').selectpicker();
    });
</script>
<script>
    function deleteblogs(tid){
        if(confirm('Are You sure'))
        {
        $.ajax({
            method:'DELETE',
            url: '{{ url('master-admin/customer-query') }}/'+tid,
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
    </script>


@endpush