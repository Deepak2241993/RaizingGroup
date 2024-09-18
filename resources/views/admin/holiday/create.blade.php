@extends('layouts.masteradmin')
@section('body')
<div class="page-content">
   <div class="row">
      <div class="col-12">
         @if ($errors->any())
         <div class="alert alert-text-text-danger">
            <ul>
               @foreach ($errors->all() as $error)
               <li>{{ $error }}</li>
               @endforeach
            </ul>
         </div>
         @endif
         <div class="card">
            <div class="card-body">
               <div class="card">
                  <div class="card-header"><strong>Holiday</strong><small> Form</small></div>
                  @if(isset($holiday))
                  <form action="{{route('holiday.update',$holiday->id)}}" method="post" enctype="multipart/form-data">
                     @method('PUT')
                     @else
                  <form action="{{route('holiday.store')}}" method="post" enctype="multipart/form-data">
                     @endif
                     @csrf
                     <div class="card-body card-block">
                        <div class="form-group mt-4">
                           <div class="form-group">
                              <div class="row">
                                 <div class="col-lg-4 mb-4">
                                    <label for="ucomp" class=" form-control-label">Company Name <span style="color:red;">*</span></label>
                                    <select name="company_id" id="compname" class="form-control" required onchange="Findbrand()">
                                       <option value="">Please select brand</option>
                                       @foreach($company as $value)
                                       <option value="{{$value->id}}"@if(isset($holiday)){{$value->id==$holiday->company_id?'selected':''}}@endif>{{$value->compname}}</option>
                                       @endforeach
                                    </select>
                                 </div>
                                 <div class="col-lg-4 mb-4">
                                    <label for="ucomp" class=" form-control-label">Brand <span style="color:red;">*</span></label>
                                    <select name="brand_id" id="empbrand" class="form-control" required>
                                        @if(isset($holiday))
                                        @foreach($brand as $value)
                                       <option value="{{$value->id}}" @if(isset($holiday)){{$value->id==$holiday->brand_id?'selected':''}}@endif>{{$value->bname}}</option>
                                       @endforeach
                                       @else
                                       <option value="">Please select brand</option>
                                       @endif
                                    </select>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="form-group mt-4">
                           @if(isset($holiday))
                           @foreach($date as $key=>$value)
                           <div class="row">
                              <div class="col-md-3 mt-4">
                                <label for="date" class="form-control-label">Holiday Date<span class="danger">*</span></label>
                                <input type="date" name="date[]" value="{{$value}}" placeholder="Date" class="form-control" required="">
                            </div>
                              <div class="col-md-3 mt-4"><label for="holidays" class="form-control-label">Holiday Name<span class="danger">*</span></label>
                                <input type="text" name="holidays[]" value="{{$store_holidays[$key]}}" placeholder="Holidays Name" class="form-control" required="">
                            </div>
                            <div class="col-md-3 mt-4">
                                <label for="ucomp" class=" form-control-label">Holiday Type <span style="color:red;">*</span></label>
                                <select name="type[]" id="empbrand" class="form-control" required="">
                                <option value="Paid" @if(isset($holiday)&& $type[$key]=='Paid') selected @endif> Paid</option>
                                <option value="Unpaid" @if(isset($holiday)&& $type[$key]=='Unpaid') selected @endif>Unpaid</option>
                                </select>
                            </div>
                              
                           </div>
                            @endforeach
                           @else
                           <div class="row">
                              <div class="col-md-3">
                                 <label for="date" class="form-control-label">Holiday Date<span class="danger">*</span></label>
                                 <input type="date" id="date" name="date[]" placeholder="Date" class="form-control" required>
                              </div>
                              <div class="col-md-3">
                                 <label for="holidays" class="form-control-label">Holiday Name<span class="danger">*</span></label>
                                 <input type="text" id="holidays" name="holidays[]" placeholder="Holidays Name" class="form-control" required>
                              </div>
                              <div class="col-md-3">
                                 <label for="ucomp" class=" form-control-label">Holiday Type <span style="color:red;">*</span></label>
                                 <select name="type[]" id="empbrand" class="form-control" required>
                                    <option value="Paid">Paid</option>
                                    <option value="Unpaid">Unpaid</option>
                                 </select>
                              </div>
                           </div>
                           @endif
                           <div id="contentappend"></div>
                        </div>
                        <div class="form-group mt-4">
                           <input type="submit" name="holiday_ok" value="Submit" class="form-control btn btn-primary" style="margin-top: 15px; border-radius: 6px; width: 130px;" />
                           <button type="button" id="vendor_service" class="btn btn-success mt-3">+Add</button>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- end col -->
</div>
</div>
@endsection
@push('footer-section-code')
<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
   $(document).ready(function () {
       $('#vendor_service').click(function () {
           $('#contentappend').append(
               '<div class="row">' +
                   '<div class="col-md-3 mt-4">' +
                       '<label for="date" class="form-control-label">Holiday Date<span class="danger">*</span></label>' +
                       '<input type="date" name="date[]" placeholder="Date" class="form-control" required>' +
                   '</div>' +
                   '<div class="col-md-3 mt-4">' +
                       '<label for="holidays" class="form-control-label">Holiday Name<span class="danger">*</span></label>' +
                       '<input type="text" name="holidays[]" placeholder="Holidays Name" class="form-control" required>' +
                   '</div>' +
                   '<div class="col-md-3 mt-4">'+
                       '<label for="ucomp" class=" form-control-label">Holiday Type <span style="color:red;">*</span></label>'+
                       '<select name="type[]" id="empbrand" class="form-control" required>'+
                           '<option value="Paid">Paid</option>'+
                           '<option value="Unpaid">Unpaid</option>'+
                       '</select>'+
                   '</div>'+
                   '<div class="col-md-3 mt-4">' +
                       '<button type="button" class="btn btn-danger mt-4 btn_remove2"><i class="fa fa-trash" aria-hidden="true"></i></button>' +
                   '</div>' +
               '</div>'
           );
       });
   
       $(document).on('click', '.btn_remove2', function () {
           $(this).closest('.row').remove();
       });
   });
   
   
   //  For Location find
   function Findbrand() {
   var comp_id = $('#compname').val();
   
   $.ajax({
       method: 'POST',
       url: '{{ url('findbrandname') }}',
       data: {
           comp_id: comp_id,
           _token: '{{ csrf_token() }}'
       },
       success: function(response) {
           if (response.success === true) {
               $('#empbrand').html(response.html); // Update the HTML of the dropdown with the response
           } else {
               $('#empbrand').html("No Data Found");
              
           }
       },
       error: function(xhr, status, error) {
           swal("Request Failed!", "An error occurred while processing your request.", "error");
       }
   });
   }
</script>
@endpush