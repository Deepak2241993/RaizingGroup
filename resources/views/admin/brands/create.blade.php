@extends('layouts.masteradmin')
@section('body')

<div class="content-wrapper">

    <!-- PAGE HEADER -->
    <section class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ isset($brand) ? 'Edit Brand' : 'Add Brand' }}</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('company.index') }}">Company</a></li>
                        <li class="breadcrumb-item active">{{ isset($brand) ? 'Edit Brand' : 'Add Brand' }}</li>
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

                <div class="card-header bg-dark text-white">
                    <h3 class="card-title">
                        <strong>Brand Form</strong>
                    </h3>
                </div>

                <div class="card-body">

                    @if(isset($brand))
                        <form action="{{ route('brands.update',$brand->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                    @else
                        <form action="{{ route('brands.store') }}" method="POST" enctype="multipart/form-data">
                    @endif

                        @csrf

                        <div class="row">

                            <!-- COMPANY NAME -->
                            <div class="col-md-6 mb-3">
                                <label>Company</label>
                                <input type="text" class="form-control" readonly value="{{ $company->compname }}">
                                <input type="hidden" name="bcomp" value="{{ $company->id }}">
                            </div>

                            <!-- BRAND NAME -->
                            <div class="col-md-6 mb-3">
                                <label>Brand Name <span class="text-danger">*</span></label>
                                <input type="text" id="bname" name="bname"
                                       class="form-control"
                                       placeholder="Enter brand name"
                                       value="{{ isset($brand) ? $brand->bname : '' }}" required>
                            </div>

                        </div>



                        <!-- BRAND EMAIL & MOBILE (Multiple Fields) -->
                        <div class="form-group mt-3">
                            <label>Brand Email & Mobile <span class="text-danger">*</span></label>

                            @if(isset($brand))
                                @php
                                    $loopemail = explode(',', $brand->bemail);
                                    $loopmob   = explode(',', $brand->bmob);
                                @endphp

                                @foreach($loopemail as $key=>$value)
                                <div class="row mb-2" id="brand_detail_more_loop{{ $key }}">
                                    <div class="col-md-5">
                                        <input type="email" name="bemail[]" value="{{ $value }}" class="form-control" placeholder="Provide Email" required >
                                    </div>
                                    <div class="col-md-5">
                                        <input type="number" name="bmob[]" class="form-control"
                                               value="{{ $loopmob[$key] }}" maxlength="10"
                                               oninput="this.value=this.value.slice(0,10)" placeholder="Provide Mobile" required>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-danger btn_removeloop" id="{{ $key }}">Remove</button>
                                    </div>
                                </div>
                                @endforeach

                                <div id="brand_detail_more"></div>

                                <button type="button" class="btn btn-success" id="brand_mail">+ Add More</button>
                            
                            @else
                                <div class="row mb-2">
                                    <div class="col-md-5">
                                        <input type="email" name="bemail[]" class="form-control" required>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="number" name="bmob[]" class="form-control"
                                               maxlength="10" required
                                               oninput="this.value=this.value.slice(0,10)">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-success" id="brand_mail">+ Add</button>
                                    </div>
                                </div>

                                <div id="brand_detail_more"></div>
                            @endif
                        </div>


                        {{-- Brand Address --}}
                        <div class="row mt-3">
                            <div class="col-md-4 mb-3">
                                <label>Street</label>
                                <input type="text" name="bstreet" class="form-control"
                                       value="{{ $brand->bstreet ?? '' }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>City</label>
                                <input type="text" name="bcity" class="form-control"
                                       value="{{ $brand->bcity ?? '' }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Postal Code</label>
                                <input type="text" name="bcode" class="form-control"
                                       value="{{ $brand->bcode ?? '' }}">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Country <span class="text-danger">*</span></label>
                                <input type="text" name="bcountry" class="form-control" required
                                       value="{{ $brand->bcountry ?? '' }}">
                            </div>
                        </div>



                        <!-- DIVISION DETAILS -->
                        <hr>
                        <label><strong>Division Details</strong></label>

                        @if(isset($brand))
                        @php
                            $bdivision = explode(',', $brand->bdivision);
                            $div_mail  = explode(',', $brand->div_mail);
                            $div_mob   = explode(',', $brand->div_mob);
                        @endphp

                        @foreach($bdivision as $key=>$value)
                        <div class="row mt-2" id="add_div_detail_loop{{ $key }}">
                            <div class="col-md-3">
                                <input type="text" name="bdivision[]" value="{{ $value }}" class="form-control" placeholder="Division Name">
                            </div>
                            <div class="col-md-3">
                                <input type="email" name="div_mail[]" value="{{ $div_mail[$key] }}" class="form-control" placeholder="Division Email">
                            </div>
                            <div class="col-md-3">
                                <input type="number" name="div_mob[]" value="{{ $div_mob[$key] }}" class="form-control"
                                       maxlength="10" oninput="this.value=this.value.slice(0,10)">
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-danger btn_remove_loop" id="{{ $key }}">Remove</button>
                            </div>
                        </div>
                        @endforeach

                        <div id="add_div_detail"></div>

                        <button type="button" class="btn btn-success mt-2" id="div_detail">+ Add More</button>

                        @else

                        <div class="row mt-2" id="add_div_detail">
                            <div class="col-md-3">
                                <input type="text" name="bdivision[]" class="form-control" placeholder="Division Name">
                            </div>
                            <div class="col-md-3">
                                <input type="email" name="div_mail[]" class="form-control" placeholder="Division Email">
                            </div>
                            <div class="col-md-3">
                                <input type="number" name="div_mob[]" class="form-control"
                                       maxlength="10" oninput="this.value=this.value.slice(0,10)">
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-success" id="div_detail">+ Add</button>
                            </div>
                        </div>

                        @endif



                        <!-- SUBMIT BUTTON -->
                        <div class="form-group mt-4">
                            <button type="submit"
                                    class="btn btn-primary"
                                    style="width:150px;">
                                {{ isset($brand) ? 'Update' : 'Submit' }}
                            </button>

                            <a href="{{ route('brands.index') }}" class="btn btn-dark" style="width:150px;">
                                Back
                            </a>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </section>

</div>

@endsection


@push('footer-section-code')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

<script>
$(document).ready(function(){

    var x = 1;

    // ADD brand email & mobile
    $('#brand_mail').click(function(){
        x++;
        $('#brand_detail_more').append(`
        <div class="row mb-2" id="brand_detail_more`+x+`">
            <div class="col-md-5">
                <input type="email" name="bemail[]" class="form-control" placeholder="Provide Email">
            </div>
            <div class="col-md-5">
                <input type="number" name="bmob[]" class="form-control" maxlength="10"
                       oninput="this.value=this.value.slice(0,10)" placeholder="Provide Mobile">
            </div>
            <div class="col-md-2">
                <button class="btn btn-danger btn_remove1" id="`+x+`">Remove</button>
            </div>
        </div>`);
    });

    // Remove dynamic email/mobile field
    $(document).on('click','.btn_remove1',function(){
        $('#brand_detail_more'+$(this).attr('id')).remove();
    });

    $(document).on('click','.btn_removeloop',function(){
        $('#brand_detail_more_loop'+$(this).attr('id')).remove();
    });

    // ADD division
    var y = 1;
    $('#div_detail').click(function(){
        y++;
        $('#add_div_detail').append(`
        <div class="row mt-2" id="add_div_detail`+y+`">
            <div class="col-md-3"><input type="text" name="bdivision[]" class="form-control" placeholder="Division Name"></div>
            <div class="col-md-3"><input type="email" name="div_mail[]" class="form-control" placeholder="Division Email"></div>
            <div class="col-md-3"><input type="number" name="div_mob[]" maxlength="10" class="form-control"
                  oninput="this.value=this.value.slice(0,10)" placeholder="Division Contact"></div>
            <div class="col-md-3"><button class="btn btn-danger btn_remove2" id="`+y+`">Remove</button></div>
        </div>`);
    });

    // REMOVE division
    $(document).on('click','.btn_remove2',function(){
        $('#add_div_detail'+$(this).attr('id')).remove();
    });

    $(document).on('click','.btn_remove_loop',function(){
        $('#add_div_detail_loop'+$(this).attr('id')).remove();
    });

});
</script>

@endpush
