@extends('layouts.masteradmin')
@section('body')

<div class="content-wrapper">

    <!-- Header -->
    <section class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Holiday Form</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('master-admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Holiday Form</li>
                    </ol>
                </div>
            </div>

        </div>
    </section>

    <!-- Main Body -->
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
                    <strong>Holiday</strong> <small>Form</small>
                </div>

                <div class="card-body">

                    @if(isset($holiday))
                        <form action="{{ route('holiday.update',$holiday->id) }}" method="post" enctype="multipart/form-data">
                        @method('PUT')
                    @else
                        <form action="{{ route('holiday.store') }}" method="post" enctype="multipart/form-data">
                    @endif

                    @csrf

                    <div class="row">

                        <!-- Company -->
                        <div class="col-lg-4 mb-4">
                            <label class="form-control-label">Company Name <span class="text-danger">*</span></label>
                            <select name="company_id" id="compname" class="form-control" required onchange="Findbrand()">
                                <option value="">Please select brand</option>
                                @foreach($company as $value)
                                <option value="{{ $value->id }}"
                                    @if(isset($holiday) && $value->id == $holiday->company_id) selected @endif>
                                    {{ $value->compname }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Brand -->
                        <div class="col-lg-4 mb-4">
                            <label class="form-control-label">Brand <span class="text-danger">*</span></label>
                            <select name="brand_id" id="empbrand" class="form-control" required>
                                @if(isset($holiday))
                                    @foreach($brand as $value)
                                    <option value="{{ $value->id }}" @if($value->id==$holiday->brand_id) selected @endif>
                                        {{ $value->bname }}
                                    </option>
                                    @endforeach
                                @else
                                <option value="">Please select brand</option>
                                @endif
                            </select>
                        </div>

                    </div>


                    <!-- Holiday Fields -->
                    <div class="mt-4">

                        @if(isset($holiday))
                        @foreach($date as $key=>$value)
                        <div class="row">

                            <div class="col-md-3 mt-4">
                                <label class="form-control-label">Holiday Date <span class="text-danger">*</span></label>
                                <input type="date" name="date[]" class="form-control" value="{{ $value }}" required>
                            </div>

                            <div class="col-md-3 mt-4">
                                <label class="form-control-label">Holiday Name <span class="text-danger">*</span></label>
                                <input type="text" name="holidays[]" class="form-control"
                                       value="{{ $store_holidays[$key] }}" required>
                            </div>

                            <div class="col-md-3 mt-4">
                                <label class="form-control-label">Holiday Type <span class="text-danger">*</span></label>
                                <select name="type[]" class="form-control" required>
                                    <option value="Paid"   @if($type[$key]=='Paid') selected @endif>Paid</option>
                                    <option value="Unpaid" @if($type[$key]=='Unpaid') selected @endif>Unpaid</option>
                                </select>
                            </div>

                        </div>
                        @endforeach

                        @else

                        <!-- Default first row -->
                        <div class="row">

                            <div class="col-md-3 mt-4">
                                <label class="form-control-label">Holiday Date <span class="text-danger">*</span></label>
                                <input type="date" name="date[]" class="form-control" required>
                            </div>

                            <div class="col-md-3 mt-4">
                                <label class="form-control-label">Holiday Name <span class="text-danger">*</span></label>
                                <input type="text" name="holidays[]" class="form-control" required>
                            </div>

                            <div class="col-md-3 mt-4">
                                <label class="form-control-label">Holiday Type <span class="text-danger">*</span></label>
                                <select name="type[]" class="form-control" required>
                                    <option value="Paid">Paid</option>
                                    <option value="Unpaid">Unpaid</option>
                                </select>
                            </div>

                        </div>

                        @endif

                        <div id="contentappend"></div>

                    </div>

                    <!-- Buttons -->
                    <div class="mt-4">
                        <input type="submit" class="btn btn-primary" style="width: 130px" 
                               value="{{ isset($holiday) ? 'Update' : 'Submit' }}">
                        <button type="button" id="vendor_service" class="btn btn-success mt-2">+ Add</button>
                    </div>

                    </form>

                </div>
            </div>

        </div>
    </section>

</div>

@endsection


@push('footer-section-code')

<!-- JS Code (NO Changes) -->
<script>
$(document).ready(function () {

    $('#vendor_service').click(function () {
        $('#contentappend').append(
            '<div class="row">' +
                '<div class="col-md-3 mt-4">' +
                    '<label class="form-control-label">Holiday Date*</label>' +
                    '<input type="date" name="date[]" class="form-control" required>' +
                '</div>' +
                '<div class="col-md-3 mt-4">' +
                    '<label class="form-control-label">Holiday Name*</label>' +
                    '<input type="text" name="holidays[]" class="form-control" required>' +
                '</div>' +
                '<div class="col-md-3 mt-4">' +
                    '<label class="form-control-label">Holiday Type*</label>' +
                    '<select name="type[]" class="form-control" required>' +
                        '<option value="Paid">Paid</option>' +
                        '<option value="Unpaid">Unpaid</option>' +
                    '</select>' +
                '</div>' +
                '<div class="col-md-3 mt-4">' +
                    '<button type="button" class="btn btn-danger btn_remove2 mt-4"><i class="fa fa-trash"></i></button>' +
                '</div>' +
            '</div>'
        );
    });

    $(document).on('click', '.btn_remove2', function () {
        $(this).closest('.row').remove();
    });

});


// Find brand by company
function Findbrand() {
    var comp_id = $('#compname').val();

    $.ajax({
        method: 'POST',
        url: '{{ url("findbrandname") }}',
        data: {
            comp_id: comp_id,
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            if (response.success) {
                $('#empbrand').html(response.html);
            } else {
                $('#empbrand').html("<option>No Data Found</option>");
            }
        },
        error: function() {
            swal("Request Failed!", "Error processing request.", "error");
        }
    });
}
</script>

@endpush
