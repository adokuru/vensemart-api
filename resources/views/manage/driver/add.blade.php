
@extends('app')

@section('content')
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
		    
        		    @if ($errors->any())
             @foreach ($errors->all() as $error)
                 <div>{{$error}}</div>
             @endforeach
         @endif
			<form id="quickForm" action="{{  url('admin/new-driver/add')}}" method="post" enctype="multipart/form-data">
    		@csrf
    			<div class="row">
    				<!-- left column -->
        				<div class="col-md-12">
        					<!-- jquery validation -->
        					<div class="card card-primary">
        						<div class="card-header"><h3 class="card-title">Driver Registration</h3> </div>
        						<!-- /.card-header -->
        						<!-- form start -->
    							
    							<div class="card-body">
    								<div class="row">
    									<div class="col-md-6">
    										<div class="form-group">
    											<label for="name"> Name </label>
    											<input type="text" name="name" value="{{ old('name') }}" class="form-control" id="name" placeholder="Enter Category Name"> 
        										@if ($errors->has('name'))
                                                  <span class="text-danger">{{ $errors->first('name') }}</span>
                                                 @endif
    										</div>
    								    </div>
    								    <div class="col-md-6">
    										<div class="form-group">
    											<label for="email"> Email </label>
    											<input type="email" name="email" value="{{ old('email') }}" class="form-control" id="email" placeholder="Enter Email"> 
        										@if ($errors->has('email'))
                                                  <span class="text-danger">{{ $errors->first('email') }}</span>
                                                 @endif
    										</div>
    								    </div>
    								</div>
    								<div class="row">
    									<div class="col-md-6">
    										<div class="form-group">
    											<label for="mobile"> Mobile </label>
    											<input type="number" name="mobile" value="{{ old('mobile') }}" class="form-control" id="mobile" placeholder="Enter Mobile Number"> 
        										@if ($errors->has('mobile'))
                                                  <span class="text-danger">{{ $errors->first('mobile') }}</span>
                                                 @endif
    										</div>
    								    </div>
    								    <div class="col-md-6">
    										<div class="form-group">
    											<label for="password"> Password </label>
    											<input type="password" name="password" value="{{ old('password') }}" class="form-control" id="name" placeholder="Enter Password"> 
        										@if ($errors->has('password'))
                                                  <span class="text-danger">{{ $errors->first('password') }}</span>
                                                 @endif
    										</div>
    								    </div>
    								</div>
    								<div class="row">
    									<div class="col-md-6">
    										<div class="form-group">
    											<label for="image">Profile Image </label>
    											<input type="file" name="image" class="form-control" id="image" placeholder="Enter Image"> 
    										 @if ($errors->has('image'))
                                              <span class="text-danger">{{ $errors->first('image') }}</span>
                                             @endif
    										</div>
    									</div>
    								
    									
    								</div>
    								<h4 class="text-primary">Vehicle Information</h4>
    								<hr/>
    								<div class="row">
    								    <div class="col-md-6">
    										<div class="form-group">
    											<label for="vehicle_number"> Vehicle Number </label>
    											<input type="text" name="vehicle_number" value="{{ old('vehicle_number') }}" class="form-control" id="name" placeholder="Enter Vehicle Number"> 
        										@if ($errors->has('vehicle_number'))
                                                  <span class="text-danger">{{ $errors->first('vehicle_number') }}</span>
                                                 @endif
    										</div>
    								    </div>
    								    <div class="col-md-6">
    										<div class="form-group">
    											<label for="vehicle_manufacture_company"> Vehicle Manufacture Company </label>
    											<input type="text" name="vehicle_manufacture_company" value="{{ old('vehicle_manufacture_company') }}" class="form-control" id="vehicle_manufacture_company" placeholder="Enter Vehicle Manufacture Company"> 
        										@if ($errors->has('vehicle_manufacture_company'))
                                                  <span class="text-danger">{{ $errors->first('vehicle_manufacture_company') }}</span>
                                                 @endif
    										</div>
    								    </div>
    								    <div class="col-md-6">
    										<div class="form-group">
    											<label for="vehicle_model"> Vehicle Model </label>
    											<input type="text" name="vehicle_model" value="{{ old('vehicle_model') }}" class="form-control" id="vehicle_model" placeholder="Enter vehicle_model"> 
        										@if ($errors->has('vehicle_model'))
                                                  <span class="text-danger">{{ $errors->first('vehicle_model') }}</span>
                                                 @endif
    										</div>
    								    </div>
    								    <div class="col-md-6">
    										<div class="form-group">
    											<label for="vehicle_registration_year"> Vehicle Registration Year </label>
    											<input type="number" name="vehicle_registration_year" value="{{ old('vehicle_registration_year') }}" class="form-control" id="vehicle_registration_year" placeholder="Enter Vehicle Registration Year"> 
        										@if ($errors->has('vehicle_registration_year'))
                                                  <span class="text-danger">{{ $errors->first('vehicle_registration_year') }}</span>
                                                 @endif
    										</div>
    								    </div>
    								    <div class="col-md-6">
    										<div class="form-group">
    											<label for="vehicle_owner_name"> Vehicle Owner Name </label>
    											<input type="text" name="vehicle_owner_name" value="{{ old('vehicle_owner_name') }}" class="form-control" id="vehicle_owner_name" placeholder="Enter vehicle_owner_name"> 
        										@if ($errors->has('vehicle_owner_name'))
                                                  <span class="text-danger">{{ $errors->first('vehicle_owner_name') }}</span>
                                                 @endif
    										</div>
    								    </div>
    								    <div class="col-md-6">
    										<div class="form-group">
    											<label for="driving_license">Upload Driving License </label>
    											<input type="file" name="driving_license" class="form-control" id="driving_license" placeholder="Enter Image"> 
    										 @if ($errors->has('driving_license'))
                                              <span class="text-danger">{{ $errors->first('driving_license') }}</span>
                                             @endif
    										</div>
    									</div>
    								    <div class="col-md-6">  
    										<div class="form-group">
    											<label for="insurance">Upload Insurance Papers </label>
    											<input type="file" name="insurance" class="form-control" id="insurance" placeholder="Enter insurance"> 
    										 @if ($errors->has('insurance'))
                                              <span class="text-danger">{{ $errors->first('insurance') }}</span>
                                             @endif
    										</div>
    									</div>
    								    
    								</div>
    								<div class="text-center">
    								    <button type="submit" class="btn btn-primary">Submit Details</button>
    								</div>
    							</div>
        					</div>
        					<!-- /.card -->
        				</div>
    				<!--/.col (left) -->
    			</div>
    			<!-- /.row -->
			</form>
		</div>
		<!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>
@stop

@section('customJS')
<script>
$(function () {

  $.validator.addMethod("alpha", function(value, element) {
    return this.optional(element) || value == value.match(/^[a-zA-Z\s]+$/);
  }, "Letters only please");

  $('#quickForm').validate({
    rules: {
      name: {
        required: true,
        alpha: true
      },
      email: {
        required: true,
        email: true,
      },
       mobile: {
        required: true,
         minlength : 10,
         maxlength : 10
      },
      password: {
        required: true,
         minlength : 6
      },
    
     image : {
       
        accept:"jpg,png,jpeg"
      },
    },
    messages: {
      name: {
        required: "Please enter a name",
       // lettersonly: "only  name"
      },
      email: {
        required: "Please enter a email address",
        email: "Please enter a vaild email address"
      },
     
      mobile :{
        required: "Please enter a mobile number", 
        minlength : 'mobile number must be 10 digit',
        maxlength : 'mobile number must be 10 digit'
      },
      password :{
        required: "Please enter a password", 
        minlength : 'password must be 6 character',
       
      },
      image:{
         
         accept: "Only image type jpg/png/jpeg is allowed"
      } 
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>
@stop