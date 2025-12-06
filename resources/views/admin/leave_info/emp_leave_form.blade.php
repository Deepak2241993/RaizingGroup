@extends('layouts.masteradmin')
@section('body')

<div class="content-wrapper">

    <!-- Page Header -->
    <section class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Employee Leave Apply</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Leave Apply</li>
                    </ol>
                </div>
            </div>

        </div>
    </section>


    <!-- Main Body Content -->
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

                <div class="card-header">
                    <h3 class="card-title">Employee Leave Apply Form</h3>

                    @if(session('message'))
                        <p class="text-success font-weight-bold">{{ session('message') }}</p>
                    @endif
                </div>


                <div class="card-body">

                    @if(isset($holiday))
                        <form action="{{route('leave.update',$holiday->id)}}" method="post" enctype="multipart/form-data">
                            @method('PUT')
                    @else
                        <form method="POST" action="{{route('leave.store')}}" id="emp_task_form" enctype="multipart/form-data">
                    @endif

                        @csrf

                        {{-- Leave Info --}}
                        @if($leave_remaining > 0)
                            <input type="hidden" id="leave_remaining" name="leave_remaining" value="{{($total_leave-$takenleave)}}"> 
                        @else
                            <input type="hidden" id="leave_remaining" name="leave_remaining" value="0"> 
                        @endif

                        <p class="text-primary">
                            Total Leave: <b class="text-dark">{{ $total_leave }}</b>,
                            Taken Leave: <b class="text-dark">{{ $takenleave }}</b>,
                            Remaining Leave: <b class="text-dark">{{ $leave_remaining }}</b>
                        </p>


                        <!-- Leave Title -->
                        <div class="form-group">
                            <label class="form-control-label">Leave Title <span class="text-danger">*</span></label>
                            <input type="text" id="l_title" name="l_title" class="form-control" required>
                        </div>


                        <!-- From Date -->
                        <div class="form-group">
                            <label class="form-control-label">From Date <span class="text-danger">*</span></label>
                            <input type="date" id="from_date" name="l_date" class="form-control" required>
                        </div>

                        <!-- To Date -->
                        <div class="form-group">
                            <label class="form-control-label">To Date <span class="text-danger">*</span></label>
                            <input type="date" id="to_date" name="to_date" class="form-control" required>
                        </div>

                        <!-- Description -->
                        <div class="form-group">
                            <label class="form-control-label">Leave Description <span class="text-danger">*</span></label>
                            <textarea name="l_desc" id="l_desc" rows="5" class="form-control" required></textarea>
                        </div>

                        <!-- Attachment -->
                        <div class="form-group">
                            <label class="form-control-label">
                                Attach Leave Application 
                                <span class="text-danger">(.jpg, .png, .pdf required)</span>
                            </label>
                            <input type="file" id="attachment" name="attachment"
                                class="form-control"
                                accept="image/jpeg,image/jpg,image/png,application/pdf"
                                required>
                        </div>


                        <!-- Submit -->
                        <div class="form-group mt-3">
                            @if($effectiveDate > date('Y-m-d'))
                                <button class="btn btn-primary" disabled>Submit</button>
                            @else
                                <button type="submit" class="btn btn-primary">Submit</button>
                            @endif
                        </div>

                        <span class="error text-danger" style="display:none">Please Enter All Details</span>

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
    // DATE RESTRICTION FOR "FROM" DATE
    document.addEventListener('DOMContentLoaded', () => {
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('from_date').setAttribute('min', today);
        document.getElementById('to_date').setAttribute('min', today);
    });
</script>

@endpush
