@extends('layouts.masteradmin')
@section('body')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Fixed Layout</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Layout</a></li>
                            <li class="breadcrumb-item active">Fixed Layout</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content Body -->
        <section class="content">
<div class="row">
            <div class="col-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card-body">
                    <div class="card">
                        <div class="card-header"><strong>Admin Task</strong><small> Form</small></div>

                        @if (isset($adminTask))
                            <form action="{{ route('admintask.update', $adminTask->id) }}" method="post"
                                enctype="multipart/form-data">
                                @method('PUT')
                                <input type="hidden" value="{{ $adminTask->id }}" name="id">
                            @else
                                <form action="{{ route('admintask.store') }}" method="post" enctype="multipart/form-data">
                        @endif
                        @csrf
                        <div class="card-body card-block">
                            <div class="form-group mb-4">
                                <label for="emp_id" class=" form-control-label">Admin Name<span
                                        class="text-danger">*</span></label>
                                <select name="emp_id" id="emp_id" class="form-control" required>
                                    <option value="#">Please select Admin first</option>

                                    @foreach ($admin as $key => $value)
                                        <option value="{{ $value->id }}"
                                            {{ isset($adminTask) && $value->id == $adminTask->emp_id ? 'selected' : '' }}>
                                            {{ $value->fname }}
                                        </option>
                                    @endforeach


                                </select>
                            </div>

                            <div class="form-group mb-4">
                                <label class="form-control-label">Task Title<span class="text-danger">*</span></label>
                                <input type="text" id="t_title" class="form-control" name="t_title"
                                    value="{{ isset($adminTask) ? $adminTask->t_title : '' }}" required>
                            </div>
                            <div class="form-group mb-4">
                                <label class="form-control-label">Deadline<span class="text-danger">*</span></label>
                                <input type="date" id="deadline" class="form-control" name="deadline"
                                    value="{{ isset($adminTask) ? $adminTask->deadline : '' }}" required>
                            </div>

                            <div class="form-group mb-4">
                                <label>Upload task related documents/images (if any)</label>
                                @if (isset($adminTask))
                                    <a href="{{ url('/images/' . $adminTask->t_file) }}">Task File</a>
                                @endif
                                <input type="file" name="t_file" multiple="multiple" class="form-control">
                            </div>
                            <div class="form-group mb-4">
                                <label for="tdetail" class="form-control-label">Task Detail</label>
                                <textarea name="t_detail" id="t_detail" rows="5" placeholder="Detail..." class="form-control">{{ isset($adminTask) ? $adminTask->t_detail : '' }}</textarea>
                            </div>
                            @if (isset($adminTask))
                                <div class="form-group mb-4">
                                    <label for="comments" class="form-control-label">Comments</label>
                                    <textarea name="comments" id="comments" rows="5" placeholder="Comments..." class="form-control">{{ isset($adminTask) ? $adminTask->comments : '' }}</textarea>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="tdetail" class="form-control-label">Task Status</label>
                                    <select class="form-select" name="status">
                                        <option @if (isset($adminTask) && $adminTask->status == '1') selected="selected" @endif value="1">
                                            Completed</option>
                                        <option @if (isset($adminTask) && $adminTask->status == '0') selected="selected" @endif value="0">
                                            Incompleted</option>
                                    </select>
                                </div>
                            @endif
                            <div class="form-group mb-4">
                                <input type="submit" name="cok" value="{{ isset($adminTask) ? 'Update' : 'Submit' }}"
                                    class="form-control btn btn-primary" id="Add_comp_submit" Name="Submit"
                                    style="margin-top: 15px; border-radius: 6px; width: 130px;" />
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

