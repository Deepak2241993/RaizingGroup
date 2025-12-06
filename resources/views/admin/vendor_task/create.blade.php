@extends('layouts.masteradmin')
@section('body')

<div class="content-wrapper">

    <!-- Page Header -->
    <section class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Vendor Task Assign</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Vendor Task Assign</li>
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
                    <h3 class="card-title">Vendor Task Assign Form</h3>
                </div>

                <div class="card-body">

                    @if(isset($vendorTaskAssign))
                        <form action="{{ route('vendor-task.update', $vendorTaskAssign->id) }}"
                              method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $vendorTaskAssign->id }}">
                    @else
                        <form action="{{ route('vendor-task.store') }}"
                              method="POST" enctype="multipart/form-data">
                    @endif
                    
                        @csrf


                        <!-- Vendor Name -->
                        <div class="form-group">
                            <label>Vendor Name <span class="text-danger">*</span></label>
                            <select name="vendor_id" id="vendor_id"
                                class="form-control"
                                required
                                {{ $type != 'Vendor' ? '' : 'readonly disabled' }}>
                                <option value="">Please select Vendor</option>

                                @foreach($vendor as $value)
                                    <option value="{{ $value->id }}"
                                        {{ isset($vendorTaskAssign) && $vendorTaskAssign->vendor_id == $value->id ? 'selected' : '' }}>
                                        {{ $value->fname }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        <!-- Deadline -->
                        <div class="form-group">
                            <label>Deadline <span class="text-danger">*</span></label>
                            <input type="date" name="deadline_date" class="form-control"
                                value="{{ isset($vendorTaskAssign)?$vendorTaskAssign->deadline_date:'' }}"
                                required
                                {{ $type != 'Vendor' ? '' : 'readonly' }}>
                        </div>


                        <!-- File Upload -->
                        <div class="form-group">
                            @if($type != 'Vendor')
                                <label>Upload Task Related File</label>
                                @if(isset($vendorTaskAssign) && $vendorTaskAssign->task_file != '')
                                    <p>
                                        <a href="{{ url('/images/'.$vendorTaskAssign->task_file) }}"
                                           target="_blank">View Existing File</a>
                                    </p>
                                @endif
                                <input type="file" name="task_file" class="form-control">
                            @else
                                @if(isset($vendorTaskAssign) && $vendorTaskAssign->task_file != '')
                                    <a href="{{ url('/images/'.$vendorTaskAssign->task_file) }}"
                                       class="btn btn-primary" target="_blank" download>
                                       Download File
                                    </a>
                                @endif
                            @endif
                        </div>


                        <!-- Task Details -->
                        <div class="form-group">
                            <label>Task Detail</label>
                            <textarea name="task_detail" class="form-control" rows="5"
                                {{ $type != 'Vendor' ? '' : 'readonly' }}>{{ isset($vendorTaskAssign)?$vendorTaskAssign->task_detail:'' }}</textarea>
                        </div>


                        <!-- Comments + Status (Only while editing) -->
                        @if(isset($vendorTaskAssign))

                        <div class="form-group">
                            <label>Comments</label>
                            <textarea name="comments" class="form-control" rows="5">{{ $vendorTaskAssign->comments }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-control">
                                <option value="">Select Status</option>
                                <option value="1" {{ $vendorTaskAssign->status==1?'selected':'' }}>Done</option>
                                <option value="2" {{ $vendorTaskAssign->status==2?'selected':'' }}>Under Process</option>
                            </select>
                        </div>

                        @endif


                        <!-- Submit -->
                        <div class="form-group mt-4">
                            <input type="submit"
                                   value="{{ isset($vendorTaskAssign)?'Update':'Submit' }}"
                                   class="btn btn-primary"
                                   style="width:150px;">
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </section>

</div>

@endsection


@push('footer-section-code')
<!-- Summernote (only if needed later) -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
@endpush
