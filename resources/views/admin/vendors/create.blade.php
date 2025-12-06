@extends('layouts.masteradmin')
@section('body')

<div class="content-wrapper">

    <!-- Page Header -->
    <section class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ isset($vendor) ? 'Edit Vendor' : 'Add Vendor' }}</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ url('dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Vendor Form</li>
                    </ol>
                </div>
            </div>

        </div>
    </section>


    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        <strong>Vendor</strong> <small>Form</small>
                    </h4>
                </div>

                <div class="card-body">

                    @if(isset($vendor))
                        <form method="POST" action="{{ route('vendor.update', $vendor->id) }}" enctype="multipart/form-data">
                            @method('PUT')
                    @else
                        <form method="POST" action="{{ route('vendor.store') }}" enctype="multipart/form-data" id="form1">
                    @endif

                        @csrf

                        <div class="row">

                            <!-- Vendor Name -->
                            <div class="col-lg-4 mb-3">
                                <label>Vendor Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control"
                                       name="fname"
                                       value="{{ $vendor->fname ?? '' }}"
                                       placeholder="Enter vendor's name" required>
                            </div>

                            <!-- Brand -->
                            <div class="col-lg-4 mb-3">
                                <label>Brand <span class="text-danger">*</span></label>
                                <select class="form-control" name="vbrand" required>
                                    <option value="">Please select brand</option>
                                    @foreach($brand as $b)
                                        <option value="{{ $b->id }}"
                                            {{ isset($vendor) && $vendor->vbrand == $b->id ? 'selected' : '' }}>
                                            {{ $b->bname }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- GST / TAX no -->
                            <div class="col-lg-4 mb-3">
                                <label>Tax Number <span class="text-danger">*</span></label>
                                <input type="text" class="form-control"
                                       name="vgstin"
                                       value="{{ $vendor->vgstin ?? '' }}"
                                       placeholder="Enter tax no" required>
                            </div>

                            <!-- Country -->
                            <div class="col-lg-4 mb-3">
                                <label>Country <span class="text-danger">*</span></label>
                                <input type="text" class="form-control"
                                       name="vcountry"
                                       value="{{ $vendor->vcountry ?? '' }}"
                                       placeholder="Country" required>
                            </div>

                            <!-- Street -->
                            <div class="col-lg-4 mb-3">
                                <label>Street <span class="text-danger">*</span></label>
                                <input type="text" class="form-control"
                                       name="vstreet"
                                       value="{{ $vendor->vstreet ?? '' }}"
                                       placeholder="Street" required>
                            </div>

                            <!-- City -->
                            <div class="col-lg-4 mb-3">
                                <label>City <span class="text-danger">*</span></label>
                                <input type="text" class="form-control"
                                       name="vcity"
                                       value="{{ $vendor->vcity ?? '' }}"
                                       placeholder="City" required>
                            </div>

                            <!-- Postal Code -->
                            <div class="col-lg-4 mb-3">
                                <label>Postal Code <span class="text-danger">*</span></label>
                                <input type="text" class="form-control"
                                       name="vcode"
                                       value="{{ $vendor->vcode ?? '' }}"
                                       placeholder="Postal Code" required>
                            </div>

                        </div>


                        <!-- Vendor Email (Dynamic Add) -->
                        <div class="row mb-3">
                            <div class="col-lg-4">
                                <label>Vendor Email <span class="text-danger">*</span></label>

                                @if(isset($vendor))
                                    @foreach(explode(',', $vendor->vemail) as $key => $val)
                                        <div class="row mt-2" id="ven_email_div{{ $key }}">
                                            <div class="col-8">
                                                <input type="email" class="form-control"
                                                       name="vemail[]"
                                                       value="{{ $val }}" placeholder="Email">
                                            </div>
                                            <div class="col-4">
                                                <button type="button" class="btn btn-danger btn_remove1"
                                                        id="{{ $key }}">Remove</button>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                                <div id="ven_email_div"></div>

                                <button type="button" class="btn btn-success mt-2" id="emp_cont">+ Add</button>
                            </div>


                            <!-- Vendor Contact -->
                            <div class="col-lg-4">
                                <label>Vendor Contact <span class="text-danger">*</span></label>

                                @if(isset($vendor))
                                    @foreach(explode(',', $vendor->vcont) as $key => $val)
                                        <div class="row mt-2" id="ven_con_div{{ $key }}">
                                            <div class="col-8">
                                                <input type="text" class="form-control"
                                                       name="vcont[]"
                                                       value="{{ $val }}"
                                                       placeholder="Mobile">
                                            </div>
                                            <div class="col-4">
                                                <button type="button"
                                                        class="btn btn-danger btn_ven_contact"
                                                        id="{{ $key }}">Remove</button>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                                <div id="ven_con_div"></div>
                                <button type="button" class="btn btn-success mt-2" id="vendor_contact">+ Add</button>
                            </div>


                            <!-- Vendor Services -->
                            <div class="col-lg-4">
                                <label>Vendor Services</label>

                                @if(isset($vendor))
                                    @foreach(explode(',', $vendor->vservice) as $key => $val)
                                        <div class="row mt-2" id="ven_service_div{{ $key }}">
                                            <div class="col-8">
                                                <input type="text" class="form-control"
                                                       name="vservice[]"
                                                       value="{{ $val }}"
                                                       placeholder="Service">
                                            </div>
                                            <div class="col-4">
                                                <button type="button" class="btn btn-danger service_button"
                                                        id="{{ $key }}">Remove</button>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                                <div id="ven_service_div"></div>
                                <button type="button" class="btn btn-success mt-2" id="emp_appointment_latter">+ Add</button>
                            </div>

                        </div>


                        <!-- Status -->
                        <div class="row mb-3">
                            <div class="col-lg-4">
                                <label>Status <span class="text-danger">*</span></label>
                                <select name="status" class="form-control" required>
                                    <option value="">Select</option>
                                    <option value="1" {{ isset($vendor) && $vendor->status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="2" {{ isset($vendor) && $vendor->status == 2 ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>


                        <button class="btn btn-primary mt-3">
                            {{ isset($vendor) ? 'Update' : 'Submit' }}
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </section>

</div>

@endsection



@push('footer-section-code')
<script>
// EMAIL ADD
let x = 1;
$('#emp_cont').click(function(){
    x++;
    $('#ven_email_div').append(`
        <div class="row mt-2" id="ven_email_div${x}">
            <div class="col-8">
                <input type="email" class="form-control" name="vemail[]" placeholder="Email">
            </div>
            <div class="col-4">
                <button type="button" class="btn btn-danger btn_remove1" id="${x}">Remove</button>
            </div>
        </div>
    `);
});

$(document).on('click','.btn_remove1',function(){
    let id = $(this).attr("id");
    $('#ven_email_div'+id).remove();
});


// CONTACT ADD
$('#vendor_contact').click(function(){
    x++;
    $('#ven_con_div').append(`
        <div class="row mt-2" id="ven_con_div${x}">
            <div class="col-8">
                <input type="text" class="form-control" name="vcont[]" placeholder="Contact">
            </div>
            <div class="col-4">
                <button type="button" class="btn btn-danger btn_ven_contact" id="${x}">Remove</button>
            </div>
        </div>
    `);
});

$(document).on('click','.btn_ven_contact',function(){
    let id = $(this).attr("id");
    $('#ven_con_div'+id).remove();
});


// SERVICE ADD
$('#emp_appointment_latter').click(function(){
    x++;
    $('#ven_service_div').append(`
        <div class="row mt-2" id="ven_service_div${x}">
            <div class="col-8">
                <input type="text" class="form-control" name="vservice[]" placeholder="Service">
            </div>
            <div class="col-4">
                <button type="button" class="btn btn-danger service_button" id="${x}">Remove</button>
            </div>
        </div>
    `);
});

$(document).on('click','.service_button',function(){
    let id = $(this).attr("id");
    $('#ven_service_div'+id).remove();
});
</script>
@endpush
