@extends('layouts.masteradmin')
@section('body')

<div class="content-wrapper">

    <!-- Header -->
    <section class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1>Edit Management Task</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Edit Task</li>
                    </ol>
                </div>

            </div>

        </div>
    </section>


    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                           <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">Management Task Form</h3>
                </div>

                <form action="{{ route('managementtask.update', $staffTask->id) }}"
                      method="POST" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <input type="hidden" name="id" value="{{ $staffTask->id }}">

                    <div class="card-body">

                        <!-- Role -->
                        <div class="form-group">
                            <label>Management Role <span class="text-danger">*</span></label>

                            <select name="user_type" id="user_type"
                                class="form-control"
                                @if($login_id != $staffTask->task_assign_from) disabled @else onchange="usertype()" @endif>

                                <option value="#">Please Select Role First</option>

                                <option value="master_admin"
                                    @selected($staffTask->user_type=='master_admin')>
                                    Master Admin
                                </option>

                                <option value="Admin"
                                    @selected($staffTask->user_type=='Admin')>
                                    Admin
                                </option>

                                <option value="HR"
                                    @selected($staffTask->user_type=='HR')>
                                    HR
                                </option>

                            </select>
                        </div>


                        <!-- Assign To -->
                        <div class="form-group">
                            <label>Management Person Name <span class="text-danger">*</span></label>

                            <select name="task_assign_to" id="task_assign_to" class="form-control"
                                @if($login_id != $staffTask->task_assign_from) disabled @endif>

                                @foreach($emp_data as $value)
                                    <option value="{{ $value->id }}" @selected($staffTask->task_assign_to==$value->id)>
                                        {{ $value->fname }}
                                    </option>
                                @endforeach

                            </select>

                            @if($login_id != $staffTask->task_assign_from)
                                <input type="hidden" name="task_assign_to" value="{{ $staffTask->task_assign_to }}">
                            @endif
                        </div>


                        <!-- Title -->
                        <div class="form-group">
                            <label>Task Title <span class="text-danger">*</span></label>
                            <input type="text" name="t_title" class="form-control"
                                   value="{{ $staffTask->t_title }}"
                                   @if($login_id != $staffTask->task_assign_from) readonly @endif required>
                        </div>


                        <!-- Deadline -->
                        <div class="form-group">
                            <label>Deadline <span class="text-danger">*</span></label>
                            <input type="date" name="deadline" id="deadline" class="form-control"
                                   value="{{ $staffTask->deadline }}"
                                   @if($login_id != $staffTask->task_assign_from) readonly @endif required>
                        </div>


                        <!-- File Upload -->
                        <div class="form-group">
                            <label>Task File</label>

                            @if($staffTask->t_file)
                                <p>
                                    <a href="{{ url('/images/'.$staffTask->t_file) }}" target="_blank"
                                       class="btn btn-info btn-sm">View File</a>
                                </p>
                            @endif

                            <input type="file" name="t_file" class="form-control"
                                   @if($login_id != $staffTask->task_assign_from) disabled @endif>
                        </div>


                        <!-- Detail -->
                        <div class="form-group">
                            <label>Task Details</label>

                            <textarea name="t_detail" class="form-control" rows="5"
                                @if($login_id != $staffTask->task_assign_from) readonly @endif>{{ $staffTask->t_detail }}</textarea>
                        </div>


                        <!-- Comments -->
                        <div class="form-group">
                            <label>Comments</label>
                            <textarea name="comments" class="form-control" rows="4">{{ $staffTask->comments }}</textarea>
                        </div>


                        <!-- Status -->
                        <div class="form-group">
                            <label>Status</label>

                            <select class="form-control" name="status">
                                <option value="0" @selected($staffTask->status=='0')>To Do</option>
                                <option value="2" @selected($staffTask->status=='2')>In Progress</option>
                                <option value="1" @selected($staffTask->status=='1')>Completed</option>
                            </select>
                        </div>


                        <!-- Submit Button -->
                        <div class="form-group mt-4">
                            <button class="btn btn-primary">Update</button>
                            <a href="{{ route('managementtask.index') }}" class="btn btn-dark">Back</a>
                        </div>

                    </div>

                </form>

            </div>

        </div>
    </section>

</div>

@endsection



@push('footer-section-code')

<script>
function usertype() {
    let type = $('#user_type').val();

    $.post('{{ url('user_type') }}', {
        user_type: type,
        _token: '{{ csrf_token() }}'
    }, function(response) {

        if(response.success){
            $('#task_assign_to').html(response.html);
        } else {
            $('#task_assign_to').html('<option>No Data Found</option>');
        }

    }).fail(function(){
        swal("Error", "Something went wrong!", "error");
    });
}
</script>


<!-- Deadline restriction -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const dateInput = document.getElementById('deadline');
    const today = new Date().toISOString().split('T')[0];
    dateInput.setAttribute('min', today);
});
</script>

@endpush
