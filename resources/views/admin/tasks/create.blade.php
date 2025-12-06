@extends('layouts.masteradmin')

@section('body')

<div class="content-wrapper">

    <!-- Page Header -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ isset($mytask) ? 'Edit Task' : 'Create Task' }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('master-dashboard') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('tasks.index') }}">Tasks</a></li>
              <li class="breadcrumb-item active">{{ isset($mytask) ? 'Edit Task' : 'New Task' }}</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Page Content -->
    <section class="content">
      <div class="container-fluid">

        <div class="row">
          <div class="col-12">

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form Card -->
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">
                        <strong>Super Admin Task</strong>
                        <small class="text-muted"> Form</small>
                    </h3>
                </div>

                <div class="card-body">

                    @if(isset($mytask))
                        <form action="{{ route('tasks.update',$mytask->id) }}" method="post" enctype="multipart/form-data">
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $mytask->id }}">
                    @else
                        <form action="{{ route('tasks.store') }}" method="post" enctype="multipart/form-data">
                    @endif

                    @csrf

                    <!-- Brand -->
                    <div class="form-group mb-3">
                        <label>Brand <span class="text-danger">*</span></label>
                        <select name="brand" id="brand" class="form-control" onchange="employee_fetch(this.value)" required>
                            <option value="">Please select Brand</option>
                            @foreach($brand as $value)
                                <option value="{{ $value->id }}" 
                                    {{ isset($mytask) && $value->id == $mytask->brand ? 'selected' : '' }}>
                                    {{ $value->bname }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Task Title -->
                    <div class="form-group mb-3">
                        <label>Task Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="t_title" 
                               value="{{ $mytask->t_title ?? '' }}" required>
                    </div>

                    <!-- File Upload -->
                    <div class="form-group mb-3">
                        <label>Upload task related documents/images (optional)</label>
                        <input type="file" name="t_file" class="form-control" multiple>
                    </div>

                    <!-- Task Detail -->
                    <div class="form-group mb-3">
                        <label>Task Detail</label>
                        <textarea name="t_detail" rows="5" class="form-control">{{ $mytask->t_detail ?? '' }}</textarea>
                    </div>

                    <!-- Comments (Only if editing) -->
                    @if(isset($mytask))
                    <div class="form-group mb-3">
                        <label>Comments</label>
                        <textarea name="comments" rows="5" class="form-control">{{ $mytask->comments ?? '' }}</textarea>
                    </div>

                    <!-- Task Status -->
                    <div class="form-group mb-3">
                        <label>Task Status</label>
                        <select class="form-control" name="status">
                            <option value="1" {{ $mytask->status == 1 ? 'selected' : '' }}>Completed</option>
                            <option value="0" {{ $mytask->status == 0 ? 'selected' : '' }}>Incomplete</option>
                        </select>
                    </div>
                    @endif

                    <!-- Submit + Back Buttons -->
                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-primary" style="width:130px;">
                            {{ isset($mytask) ? 'Update' : 'Submit' }}
                        </button>

                        <a href="{{ route('tasks.index') }}" class="btn btn-dark" style="width:130px;">
                            Back
                        </a>
                    </div>

                    </form>

                </div>

            </div>

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

@endpush
