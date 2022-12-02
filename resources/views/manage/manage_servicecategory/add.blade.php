
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
							<h3 class="card-title">Add Service Category</h3> </div>
						<!-- /.card-header -->
						<!-- form start -->
						<form id="quickForm" action="{{  url('admin/manageservice_category/add')}}" method="post" enctype="multipart/form-data">
							@csrf
							<div class="card-body">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="name">Category Name </label>
											<input type="text" name="name" value="{{ old('name') }}" class="form-control" id="name" placeholder="Enter Category Name"> 
										@if ($errors->has('name'))
                                          <span class="text-danger">{{ $errors->first('name') }}</span>
                                         @endif
										</div>
										 
									</div>
									
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="cetegory_image">Category Image </label>
											<input type="file" name="cetegory_image" accept="image/*" class="form-control" id="cetegory_image" placeholder="Enter Category Image"> 
										 @if ($errors->has('cetegory_image'))
                                          <span class="text-danger">{{ $errors->first('cetegory_image') }}</span>
                                         @endif
										</div>
									    
									</div>
									<div class="col-md-6">
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

  $('#quickForm1').validate({
    rules: {
      name: {
        required: true,
        alpha: true
      },
      status: {
        required: true,
      },
     cetegory_image : {
        required: true,
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
         required: "Please provide a image",
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