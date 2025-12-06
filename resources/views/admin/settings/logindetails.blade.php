@extends('layouts.masteradmin')
@section('body')

<div class="page-content">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Web Login Details</h4>
                    <p class="card-title-desc">
                        Track login & logout activity of all employees with exact locations.
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
                                    <td>{{ $loop->iteration }}</td>

                                    <td>{{ $value->uemail }}</td>

                                    <td>{{ $value->login_time }}</td>

                                    <td>{{ $value->logout_time ?? '--' }}</td>

                                    <td>
                                        <span class="btn btn-sm btn-{{ $value->current_status == 1 ? 'success' : 'danger' }} disabled">
                                            {{ $value->current_status == 1 ? 'Login' : 'Logout' }}
                                        </span>
                                    </td>

                                    <td>
                                        @if($value->latitude && $value->longitude)
                                            <a href="https://maps.google.com/?q={{ $value->latitude }},{{ $value->longitude }}" 
                                               target="_blank"
                                               class="badge bg-info text-dark p-2">
                                                View Login Location
                                            </a>
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if($value->logout_lat && $value->logout_long)
                                            <a href="https://maps.google.com/?q={{ $value->logout_lat }},{{ $value->logout_long }}" 
                                               target="_blank"
                                               class="badge bg-warning text-dark p-2">
                                                View Logout Location
                                            </a>
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    

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
@endpush
