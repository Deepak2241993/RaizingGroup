@extends('layouts.masteradmin')

@section('body')

<div class="content-wrapper">

    <!-- Page Header -->
    <section class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1>Employee Task Form</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('master-dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Employee Task</li>
                    </ol>
                </div>

            </div>

        </div>
    </section>

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">

            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">
                        {{ isset($employeeTask) ? 'Edit Employee Task' : 'Add Employee Task' }}
                    </h3>
                </div>

                <div class="card-body">

                    <!-- Errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Form Start -->
                    @if(isset($employeeTask))
                        <form action="{{ route('employeetask.update', $employeeTask->id) }}" 
                              method="post" enctype="multipart/form-data">
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $employeeTask->id }}">
                    @else
                        <form action="{{ route('employeetask.store') }}" 
                              method="post" enctype="multipart/form-data">
                    @endif

                        @csrf

                        <div class="row">

                            <!-- Employee Name -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Employee Name <span class="text-danger">*</span></label>
                                <input type="text" readonly class="form-control"
                                       value="{{ isset($employee) ? $employee->fname : '' }}">
                                <input type="hidden" name="emp_id"
                                       value="{{ isset($employee) ? $employee->id : '' }}">
                            </div>

                            <!-- Task Title -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Task Title <span class="text-danger">*</span></label>
                                <input type="text" name="t_title" class="form-control"
                                       value="{{ isset($employeeTask) ? $employeeTask->t_title : '' }}" required>
                            </div>

                            <!-- Deadline -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Deadline <span class="text-danger">*</span></label>
                                <input type="date" name="deadline" id="deadline" class="form-control"
                                       value="{{ isset($employeeTask) ? $employeeTask->deadline : '' }}"
                                       required>
                            </div>

                            <!-- File -->
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Upload Files (if any)</label>
                                @if(isset($employeeTask) && $employeeTask->t_file)
                                    <p>
                                        <a href="{{ url('/images/'.$employeeTask->t_file) }}" target="_blank">
                                            View Existing File
                                        </a>
                                    </p>
                                @endif
                                <input type="file" name="t_file" class="form-control" multiple>
                            </div>

                            <!-- Task Detail -->
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Task Detail</label>
                                <textarea name="t_detail" rows="4" class="form-control">{{ isset($employeeTask) ? $employeeTask->t_detail : '' }}</textarea>
                            </div>

                            <!-- Comments (Edit Mode Only) -->
                            @if(isset($employeeTask))
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Comments</label>
                                    <textarea name="comments" rows="4" class="form-control">{{ $employeeTask->comments }}</textarea>
                                </div>

                                <!-- Status -->
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Task Status</label>
                                    <select name="status" class="form-select">
                                        <option value="0" @if($employeeTask->status=='0') selected @endif>To Do</option>
                                        <option value="2" @if($employeeTask->status=='2') selected @endif>In Progress</option>
                                        <option value="1" @if($employeeTask->status=='1') selected @endif>Completed</option>
                                    </select>
                                </div>
                            @endif

                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary mt-3">
                            {{ isset($employeeTask) ? 'Update' : 'Submit' }}
                        </button>

                        <a href="{{ route('employeetask.index') }}" class="btn btn-dark mt-3">Back</a>

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
document.addEventListener('DOMContentLoaded', () => {
    let dateInput = document.getElementById('deadline');
    let today = new Date().toISOString().split('T')[0];
    dateInput.min = today;
});
</script>

@endpush
