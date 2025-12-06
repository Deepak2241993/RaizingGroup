@extends('layouts.masteradmin')
@section('body')

<div class="page-content">
    <div class="row">
        <div class="col-12">

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="m-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card">
                <div class="card-body">

                    <div class="card">
                        <div class="card-header">
                            <strong>Admin</strong> <small>Form</small>
                        </div>

                        {{-- FORM START --}}
                        @if(isset($admin))
                            <form action="{{ route('admins_update', $admin->id) }}" method="post" enctype="multipart/form-data">
                                @method('PUT')
                                <input type="hidden" name="id" value="{{ $admin->id }}">
                        @else
                            <form action="{{ route('admins_create') }}" method="post" enctype="multipart/form-data" id="form1" onsubmit="return emp_validation()">
                        @endif

                            @csrf

                            <div class="card-body card-block">

                                {{-- Full Name --}}
                                <div class="form-group mb-4">
                                    <label for="fname" class="form-control-label">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" id="fname" name="fname" class="form-control"
                                           placeholder="Enter employee's full name"
                                           value="{{ isset($admin) ? $admin->fname : '' }}" required>
                                </div>

                                {{-- Email --}}
                                <div class="form-group mb-4">
                                    <label for="empmail" class="form-control-label">Personal Email ID <span class="text-danger">*</span></label>
                                    <input type="email" id="empmail" class="form-control" readonly
                                           value="{{ isset($admin) ? $admin->empmail : '' }}"
                                           placeholder="Enter Personal Email ID">
                                </div>

                                {{-- Mobile Number --}}
                                <div class="form-group mb-4">
                                    <label for="empmob" class="form-control-label">Mobile No. <span class="text-danger">*</span></label>
                                    <input type="text" id="empmob" class="form-control" name="empmob"
                                           placeholder="Enter Mobile No."
                                           value="{{ isset($admin) ? $admin->empmob : '' }}" required>
                                </div>

                                {{-- Aadhar --}}
                                <div class="form-group mb-4">
                                    <label for="aadhar_no" class="form-control-label">Aadhar No.</label>
                                    <input type="text" id="aadhar_no" class="form-control" name="aadhar_no"
                                           placeholder="Enter employee's Aadhar No"
                                           value="{{ isset($admin) ? $admin->aadhar_no : '' }}">
                                </div>

                                {{-- PAN --}}
                                <div class="form-group mb-4">
                                    <label for="pan_no" class="form-control-label">PAN No.</label>
                                    <input type="text" id="pan_no" class="form-control" name="pan_no"
                                           placeholder="Enter employee's PAN No"
                                           value="{{ isset($admin) ? $admin->pan_no : '' }}">
                                </div>

                                {{-- Submit --}}
                                <div class="form-group mb-4">
                                    <input type="submit"
                                           value="{{ isset($admin) ? 'Update' : 'Submit' }}"
                                           class="btn btn-primary"
                                           style="border-radius: 6px; width: 130px;">
                                </div>

                            </div>
                        </form>
                        {{-- FORM END --}}

                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@push('footer-section-code')

<script>
function emp_validation() {

    var fname = $("#fname").val();
    var empmail = $("#empmail").val();
    var empmob = $("#empmob").val();
    
    if(fname == '') {
        alert('Please enter Name');
        return false;
    }
    if(empmail == '') {
        alert('Please enter Email ID');
        return false;
    }
    if(empmob == '') {
        alert('Please enter Mobile No');
        return false;
    }

    return true;
}
</script>

@endpush
