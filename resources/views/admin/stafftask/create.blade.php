@extends('layouts.masteradmin')
@section('body')

<div class="content-wrapper">

    <!-- HEADER -->
    <section class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1>Create Management Task</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Management Task</li>
                    </ol>
                </div>

            </div>

        </div>
    </section>


    <!-- MAIN CONTENT -->
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
                    <h3 class="card-title">Management Task — Form</h3>
                </div>

                <div class="card-body">

                    <form action="{{ route('managementtask.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="row">

                            <!-- Management Role -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Management Role <span class="text-danger">*</span></label>
                                <select name="user_type" id="user_type" class="form-control" required onchange="usertype()">
                                    <option value="">Please Select Role First</option>
                                    <option value="master_admin">Master Admin</option>
                                    <option value="Admin">Admin</option>
                                    <option value="HR">HR</option>
                                </select>
                            </div>

                            <!-- Management Person Name -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Management Person Name <span class="text-danger">*</span></label>
                                <select name="task_assign_to" id="task_assign_to" class="form-control" required>
                                    <option value="">Please select Role first</option>
                                </select>
                            </div>

                            <!-- Task Title -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Task Title <span class="text-danger">*</span></label>
                                <input type="text" name="t_title" class="form-control" required>
                            </div>

                            <!-- Deadline -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Deadline <span class="text-danger">*</span></label>
                                <input type="date" name="deadline" id="deadline" class="form-control" required>
                            </div>

                            <!-- File Upload -->
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Upload task related documents/images (if any)</label>
                                <input type="file" name="t_file" class="form-control">
                            </div>

                            <!-- Task Details -->
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Task Detail</label>
                                <textarea name="t_detail" class="form-control" rows="5" placeholder="Detail..."></textarea>
                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Submit</button>

                        <a href="{{ route('managementtask.index') }}" class="btn btn-secondary mt-3">Back</a>

                    </form>

                </div>

            </div>

        </div>
    </section>

</div>

@endsection



@push('footer-section-code')

<!-- Summernote -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>


<script>
function usertype() {
    var user_type = $('#user_type').val();
    
    $.ajax({
        method: 'POST',
        url: '{{ url('user_type') }}',
        data: {
            user_type: user_type,
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            if (response.success === true) {
                $('#task_assign_to').html(response.html);
            } else {
                $('#task_assign_to').html("<option>No Data Found</option>");
            }
        },
        error: function(xhr) {
            swal("Request Failed!", "An error occurred while processing your request.", "error");
        }
    });
}
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const deadlineInput = document.getElementById('deadline');
    const today = new Date().toISOString().split('T')[0];
    deadlineInput.setAttribute('min', today);
});
</script>

@endpush
