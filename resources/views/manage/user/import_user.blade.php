
@extends('Admin/app')

@section('content')
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<!-- left column -->
				<div class="col-md-12">
					<!-- jquery validation -->
					<div class="card card-primary">
						<div class="card-header">
							<h3 class="card-title">Add User</h3> </div>
						<!-- /.card-header -->
						<!-- form start -->
						<form id="quickForm" action="{{  url('admin/import-excel/upload')}}" method="post" enctype="multipart/form-data">
							@csrf
							<div class="card-body">
								
							 @if (count($errors) > 0)
                <div class="row">
                    <div class="col-md-8 col-md-offset-1">
                      <div class="alert alert-danger alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <h4><i class="icon fa fa-ban"></i> Error!</h4>
                          @foreach($errors->all() as $error)
                          {{ $error }} <br>
                          @endforeach      
                      </div>
                    </div>
                </div>
                @endif
  
                @if (Session::has('success'))
                    <div class="row">
                      <div class="col-md-8 col-md-offset-1">
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5>{!! Session::get('success') !!}</h5>   
                        </div>
                      </div>
                    </div>
                @endif
                
                <div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="name"> Name </label>
					<input type="file" name="file" class="form-control" required>
						@if ($errors->has('name'))
                          <span class="text-danger">{{ $errors->first('name') }}</span>
                         @endif
					</div>
			    </div>
								    
								</div>
							
							</div>
							<!-- /.card-body -->
							<div class="card-footer">
								<button type="submit" class="btn btn-primary">Submit</button>
							</div>
						</form>
					</div>
					<!-- /.card -->
				</div>
				<!--/.col (left) -->
				<!-- right column -->
				<div class="col-md-6"> </div>
				<!--/.col (right) -->
			</div>
			<!-- /.row -->
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