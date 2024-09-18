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
                    {{'Web Login Details'}}
                    @if(session('message')) <p style="color:rgb(6, 82, 6); font-weight: 600;">{{session('message')}}</p>@endif
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Employee Email</th>
                                <th>Login Time</th>
                                <th>Logout Time</th>
                                <th>Login Status</th>
                                <th>Login Location</th>
                                <th>Logout Location</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $value)
                            <tr>
                                
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$value->uemail}}</td>
                                <td>{{$value->login_time}}</td>
                                <td>{{$value->logout_time}}</td>
                                <td>
                                    <a href="javascript:void(0);"  class="btn btn-outline-{{$value->current_status==1?'primary':'danger'}} disabled">{{$value->current_status==1?'Login':'Logout'}}</a>
                                    
                                </td>
                                <td><a href="https://maps.google.com/?q={{ $value->latitude }},{{ $value->longitude }}" target="_blank" class="theme-info">Login Loaction</a></td>
                                <td><a href="https://maps.google.com/?q={{ $value->logout_lat }},{{ $value->logout_long }}" target="_blank" class="theme-info">Logout Loaction</a></td>
                                
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
    function deletepages(tid){
        if(confirm('Are You sure'))
        {
        $.ajax({
            method:'DELETE',
            url: '{{ url('admin/settings/') }}/'+tid,
            data:{
                id: tid,
                _token: '{{ csrf_token() }}'
            },
            success:function(response){
                
                if(response.success)
                {
                    location.reload();
                    swal("Deleted!", "Data Deleted Successfully!", "error");

                }
                
            }
        });
    }
}
    </script>


@endpush