@extends('layouts.masteradmin')
@section('body')
@php
    $gst_locations = [
    "" => "Select Tax Location",
    "Jammu" => "01. Jammu & Kashmir",
    "Himachal_Pradesh" => "02. Himachal Pradesh",
    "Punjab" => "03. Punjab",
    "Chandigarh" => "04. Chandigarh",
    "Uttarakhand" => "05. Uttarakhand",
    "Haryana" => "06. Haryana",
    "Delhi" => "07. Delhi",
    "Rajasthan" => "08. Rajasthan",
    "Uttar_Pradesh" => "09. Uttar Pradesh",
    "Bihar" => "10. Bihar",
    "Sikkim" => "11. Sikkim",
    "Arunachal_Pradesh" => "12. Arunachal Pradesh",
    "Nagaland" => "13. Nagaland",
    "Manipur" => "14. Manipur",
    "Mizoram" => "15. Mizoram",
    "Tripura" => "16. Tripura",
    "Meghalaya" => "17. Meghalaya",
    "Assam" => "18. Assam",
    "West_Bengal" => "19. West Bengal",
    "Jharkhand" => "20. Jharkhand",
    "Orissa" => "21. Orissa",
    "Chhattisgarh" => "22. Chhattisgarh",
    "Madhya_Pradesh" => "23. Madhya Pradesh",
    "Gujarat" => "24. Gujarat",
    "Daman_&_Diu" => "25. Daman & Diu",
    "Dadra_&_Nagar_Haveli" => "26. Dadra & Nagar Haveli",
    "Maharashtra" => "27. Maharashtra",
    "Andhra_Pradesh" => "28. Andhra Pradesh",
    "Karnataka" => "29. Karnataka",
    "Goa" => "30. Goa",
    "Lakshadweep" => "31. Lakshadweep",
    "Kerala" => "32. Kerala",
    "Tamil_Nadu" => "33. Tamil Nadu",
    "Puducherry" => "34. Puducherry",
    "Andaman_&_Nicobar_Islands" => "35. Andaman & Nicobar Islands",
    "Telengana" => "36. Telengana",
    "Andrapradesh" => "37. Andrapradesh",
    "Dubai" => "38. United Arab Emirates",
    "Colombo" => "38. Sri Lanka",
    "Zagreb" => "39. Croatia",
    "Amman" => "40. Jordan",
    "Bangkok" => "40. Thailand"
];

@endphp



<div class="content-wrapper">

    <!-- Page Header -->
    <section class="content-header">
      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">
            <h1>{{ isset($company) ? 'Edit Company' : 'Add Company' }}</h1>
          </div>

          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <a href="{{ route('master-dashboard') }}">Home</a>
              </li>
              <li class="breadcrumb-item">
                <a href="{{ route('company.index') }}">Company</a>
              </li>
              <li class="breadcrumb-item active">
                {{ isset($company) ? 'Edit Company' : 'New Company' }}
              </li>
            </ol>
          </div>

        </div>

      </div>
    </section>

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Company Form -->
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">
                        <strong>Company</strong> 
                        <small class="text-muted">Form</small>
                    </h3>
                </div>

                <div class="card-body">

                    @if(isset($company))
                        <form action="{{ route('company.update',$company->id) }}" method="post" enctype="multipart/form-data">
                        @method('PUT')
                    @else
                        <form action="{{ route('company.store') }}" method="post" enctype="multipart/form-data">
                    @endif

                    @csrf

                    <div class="row">

                        <!-- Company Name -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Company <span class="text-danger">*</span></label>
                                <input type="text" name="compname" 
                                       class="form-control"
                                       value="{{ $company->compname ?? '' }}" 
                                       placeholder="Enter company name" required>
                            </div>
                        </div>

                        <!-- Tax ID -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tax ID</label>
                                <input type="text" name="cgst"
                                       class="form-control" 
                                       value="{{ $company->cgst ?? '' }}"
                                       placeholder="Enter Tax ID">
                            </div>
                        </div>

                        <!-- Tax Location -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tax Location</label>
                                <select name="gst_location" class="form-control">
                                    @foreach($gst_locations as $value => $text)
                                        <option value="{{ $value }}"
                                            {{ isset($company) && $company->gst_location == $value ? 'selected' : '' }}>
                                            {{ $text }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Tax Document -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tax Document</label>
                                <input type="file" name="gst_file" class="form-control">
                            </div>
                        </div>

                        <!-- Tax Card -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tax Card</label>
                                <input type="file" name="cpan" class="form-control">
                            </div>
                        </div>

                        <!-- TAN -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>TAX Number</label>
                                <input type="text" name="tan"
                                       class="form-control"
                                       value="{{ $company->tan ?? '' }}"
                                       placeholder="Enter TAX number">
                            </div>
                        </div>

                        <!-- Company ID -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Company ID Document</label>
                                <input type="file" name="mca" class="form-control">
                            </div>
                        </div>

                        <!-- Billing Address -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Billing Address</label>
                                <input type="text" name="billing_address"
                                       class="form-control" 
                                       value="{{ $company->billing_address ?? '' }}"
                                       placeholder="Enter Billing Address">
                            </div>
                        </div>

                        <!-- Billing Address Location -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Billing Address Location</label>
                                <input type="text" name="billing_address_location"
                                       class="form-control" 
                                       value="{{ $company->billing_address_location ?? '' }}"
                                       placeholder="Billing Address Location">
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Email <span class="text-danger">*</span></label>
                                <input type="email" name="compemail" 
                                       class="form-control" 
                                       value="{{ $company->compemail ?? '' }}"
                                       placeholder="Enter Email" required>
                            </div>
                        </div>

                        <!-- Mobile -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Mobile <span class="text-danger">*</span></label>
                                <input type="number" name="compmob" maxlength="10"
                                       class="form-control"
                                       value="{{ $company->compmob ?? '' }}"
                                       placeholder="Enter Mobile No" required>
                            </div>
                        </div>

                        <!-- Head Office Address -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Head Office Address <span class="text-danger">*</span></label>
                                <input type="text" name="head_office_address"
                                       class="form-control"
                                       value="{{ $company->head_office_address ?? '' }}"
                                       placeholder="Head Office Address" required>
                            </div>
                        </div>

                        <!-- Street -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Street <span class="text-danger">*</span></label>
                                <input type="text" name="compstreet" 
                                       class="form-control"
                                       value="{{ $company->compstreet ?? '' }}"
                                       placeholder="Enter Street" required>
                            </div>
                        </div>

                        <!-- City -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>City <span class="text-danger">*</span></label>
                                <input type="text" name="compcity" 
                                       class="form-control"
                                       value="{{ $company->compcity ?? '' }}"
                                       placeholder="Enter City" required>
                            </div>
                        </div>

                        <!-- Postal Code -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Postal Code</label>
                                <input type="number" name="compcode"
                                       class="form-control"
                                       value="{{ $company->compcode ?? '' }}"
                                       placeholder="Enter Postal Code">
                            </div>
                        </div>

                        <!-- Country -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Country <span class="text-danger">*</span></label>
                                <input type="text" name="compcountry"
                                       class="form-control"
                                       value="{{ $company->compcountry ?? '' }}"
                                       placeholder="Enter Country" required>
                            </div>
                        </div>

                        <!-- Website -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Website Link</label>
                                <input type="url" name="web_link"
                                       class="form-control"
                                       value="{{ $company->web_link ?? '' }}"
                                       placeholder="Enter Website URL">
                            </div>
                        </div>

                    </div> <!-- end row -->

                    <!-- Submit Buttons -->
                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary" style="width:130px;">
                            {{ isset($company) ? 'Update' : 'Submit' }}
                        </button>

                        <a href="{{ route('company.index') }}" 
                           class="btn btn-dark" style="width:130px;">
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

<!-- Summernote (optional) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

@endpush
