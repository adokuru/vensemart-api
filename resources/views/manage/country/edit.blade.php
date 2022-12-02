
@extends('app')

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
							<h3 class="card-title">Edit Country</h3> </div>
						<!-- /.card-header -->
						<!-- form start -->
						<form id="quickForm" action="{{  url('admin/country/edit').'/'.$countrydata->id}}" method="post" enctype="multipart/form-data">
							@csrf
							<div class="card-body">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="code">Country Code </label>
											<input type="text" name="code" value="{{ old('code',$countrydata->country_code) }}" class="form-control" id="code" placeholder="Enter country Code"> 
										@if ($errors->has('code'))
                                          <span class="text-danger">{{ $errors->first('code') }}</span>
                                         @endif
										</div>
										 
									</div>
									
									<div class="col-md-6">
										<div class="form-group">
											<label for="name">Country Name </label>
											<input type="text" name="name" value="{{ old('name',$countrydata->country_name) }}" class="form-control" id="name" placeholder="Enter country Name"> 
										@if ($errors->has('name'))
                                          <span class="text-danger">{{ $errors->first('name') }}</span>
                                         @endif
										</div>
										 
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="name">Status</label>
											<select name="status" class="form-control">
											  
												<option value="1"  {{ ((old('status') == 1) || ( $countrydata->status == 1) ) ? 'selected' : ''}}>Active</option>
												<option value="2"  {{ ((old('status') === "2" ) || ( $countrydata->status == 2) ) ? 'selected' : ''}}>Inactive</option>
												
											</select>
											@if ($errors->has('status'))
                                          <span class="text-danger">{{ $errors->first('status') }}</span>
                                         @endif
										</div>
										 
									</div>
								</div>
							
							</div>
							<!-- /.card-body -->
							<div class="card-footer">
								<button type="submit" class="btn btn-primary">update</button>
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
      status: {
        required: true,
      },
     cetegory_image : {
       
        accept:"jpg,png,jpeg"
      },
    },
    messages: {
      name: {
        required: "Please enter a category name",
       // lettersonly: "only  name"
      },
      status: {
        required: "Please provide a password",
      },
      cetegory_image:{
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