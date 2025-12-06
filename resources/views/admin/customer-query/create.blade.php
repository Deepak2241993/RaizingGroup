@extends('layouts.masteradmin')

@section('body')

<div class="content-wrapper">

    <!-- Page Header -->
    <section class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1>{{ isset($customer_query) ? 'Edit Customer Query' : 'Add Customer Query' }}</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('master-dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('customer-query.index') }}">Customer Query</a></li>
                        <li class="breadcrumb-item active">{{ isset($customer_query) ? 'Edit' : 'Add' }}</li>
                    </ol>
                </div>

            </div>

        </div>
    </section>


    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">

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


            <!-- Form Card -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <strong>Customer Query</strong>
                        <small class="text-muted">Form</small>
                    </h3>
                </div>

                <div class="card-body">

                    @if(isset($customer_query))
                        <form action="{{ route('customer-query.update', $customer_query->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                    @else
                        <form action="{{ route('customer-query.store') }}" method="POST" enctype="multipart/form-data">
                    @endif

                    @csrf

                    <div class="row">

                        <!-- Lead Type -->
                        <div class="col-md-6 mb-3">
                            <label>Lead Type <span class="text-danger">*</span></label>
                            <select class="form-control" name="leadtype" required>
                                <option value="">Please Select</option>
                                <option {{ isset($customer_query) && $customer_query->leadtype=='Cold Lead' ? 'selected' : '' }}>Cold Lead</option>
                                <option {{ isset($customer_query) && $customer_query->leadtype=='Hot Lead' ? 'selected' : '' }}>Hot Lead</option>
                                <option {{ isset($customer_query) && $customer_query->leadtype=='Warm Lead' ? 'selected' : '' }}>Warm Lead</option>
                            </select>
                        </div>

                        <!-- Full Name -->
                        <div class="col-md-6 mb-3">
                            <label>Full Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control"
                                   name="ct_name"
                                   value="{{ $customer_query->ct_name ?? '' }}"
                                   placeholder="Full Name" required>
                        </div>

                        <!-- Company Email -->
                        <div class="col-md-6 mb-3">
                            <label>Company Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control"
                                   name="ct_mail"
                                   value="{{ $customer_query->ct_mail ?? '' }}"
                                   placeholder="Email" required>
                        </div>

                        <!-- Contact Numbers -->
                        <div class="col-md-6 mb-3">
                            <label>Contact No. <span class="text-danger">*</span></label>
                            <input type="text" class="form-control mb-2"
                                   name="ct_mob"
                                   value="{{ $customer_query->ct_mob ?? '' }}"
                                   placeholder="Mobile (Whatsapp)" required>

                            <input type="text" class="form-control"
                                   name="ct_phone"
                                   value="{{ $customer_query->ct_phone ?? '' }}"
                                   placeholder="Landline Number (optional)">
                        </div>

                        <!-- Passport -->
                        <div class="col-md-6 mb-3">
                            <label>Passport No.</label>
                            <input type="text" class="form-control"
                                   name="ct_passport"
                                   value="{{ $customer_query->ct_passport ?? '' }}"
                                   placeholder="Passport Number">
                        </div>

                        <!-- Nationality -->
                        <div class="col-md-6 mb-3">
                            <label>Nationality <span class="text-danger">*</span></label>
                            <input type="text" class="form-control"
                                   name="nationality"
                                   value="{{ $customer_query->nationality ?? '' }}"
                                   placeholder="Enter Nationality" required>
                        </div>

                    </div>

                    <hr>

                    <div class="row">

                        <!-- Reference Through -->
                        <div class="col-md-6 mb-3">
                            <label>Reference Through</label>
                            <select class="form-control" name="reference_through">
                                <option value="">Please Select</option>
                                <option {{ isset($customer_query)&&$customer_query->reference_through=='Friends'?'selected':'' }}>Friends</option>
                                <option {{ isset($customer_query)&&$customer_query->reference_through=='Social Media'?'selected':'' }}>Social Media</option>
                                <option {{ isset($customer_query)&&$customer_query->reference_through=='Channel Partner'?'selected':'' }}>Channel Partner</option>
                            </select>
                        </div>

                        <!-- Profession -->
                        <div class="col-md-6 mb-3">
                            <label>Profession</label>
                            <select class="form-control" name="profession">
                                <option value="">Please Select</option>
                                <option {{ isset($customer_query)&&$customer_query->profession=='Businuss'?'selected':'' }}>Businuss</option>
                            </select>
                        </div>

                        <!-- Address -->
                        <div class="col-md-6 mb-3">
                            <label>Address</label>
                            <textarea class="form-control" name="address" rows="2"
                                      placeholder="Enter address">{{ $customer_query->address ?? '' }}</textarea>
                        </div>

                        <!-- Query Details -->
                        <div class="col-md-6 mb-3">
                            <label>Enquiry Detail</label>
                            <textarea class="form-control" name="query_details" rows="5"
                                      placeholder="Enter enquiry details...">
                                {{ $customer_query->query_details ?? '' }}
                            </textarea>
                        </div>

                    </div>

                    <!-- Submit -->
                    <button type="submit" class="btn btn-primary" style="width:130px;">
                        {{ isset($customer_query) ? 'Update' : 'Submit' }}
                    </button>

                    </form>

                </div>
            </div>

        </div>
    </section>

</div>

@endsection



@push('footer-section-code')

<!-- Summernote -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

<!-- Dynamic Fields Script (kept exactly as you had it) -->
<script>
$(document).ready(function(){
    var i=1;
    $('#add_more_brand').click(function(){
        i++;
        $('#brand_add_row').append('<div class="row" id="brand_add_row'+i+'" style="margin-top:5px;"><div class="col-lg-10"><input type="text" name="cbrand[]" class="form-control"></div><div class="col-lg-2"><img src="images/cross.png" id="'+i+'" width="37" class="btn_remove"></div></div>');
    });

    $(document).on('click', '.btn_remove', function(){
        $('#brand_add_row'+$(this).attr("id")).remove();
    });

    var x=1;
    $('#brand_mail').click(function(){
        x++;
        $('#brand_detail_more').append('<div class="row" id="brand_detail_more'+x+'" style="margin-top:5px;"><div class="col-lg-5"><input type="email" name="bemail[]" class="form-control"></div><div class="col-lg-5"><input type="number" name="bmob[]" class="form-control"></div><div class="col-lg-2"><button class="btn btn-danger btn_remove1" id="'+x+'">-Remove</button></div></div>');
    });

    $(document).on('click', '.btn_remove1', function(){
        $('#brand_detail_more'+$(this).attr("id")).remove();
    });

    var y=1;
    $('#div_detail').click(function(){
        y++;
        $('#add_div_detail').append('<div class="row" id="add_div_detail'+y+'" style="margin-top:5px;"><div class="col-lg-3"><input type="text" name="bdivision[]" class="form-control"></div><div class="col-lg-3"><input type="email" name="div_mail[]" class="form-control"></div><div class="col-lg-3"><input type="number" name="div_mob[]" class="form-control"></div><div class="col-lg-3"><button class="btn btn-danger btn_remove2" id="'+y+'">-Remove</button></div></div>');
    });

    $(document).on('click', '.btn_remove2', function(){
        $('#add_div_detail'+$(this).attr("id")).remove();
    });

});
</script>

@endpush
