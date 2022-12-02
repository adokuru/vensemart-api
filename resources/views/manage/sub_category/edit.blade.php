
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
							<h3 class="card-title">Edit Sub Category</h3> </div>
						<!-- /.card-header -->
						<!-- form start -->
						<form id="quickForm" action="{{  url('admin/managesubcategory/edit').'/'.$subCat->id}}" method="post" enctype="multipart/form-data">
							@csrf
							<div class="card-body">
								<div class="row">
								    <div class="col-md-6">
										<div class="form-group">
											<label for="name">Category Name</label>
											<select name="category_id" class="form-control">
											 <?php if( count($cat_listing ) > 0 ){ foreach($cat_listing as $cat_list){?>
											 <option value="{{ $cat_list->id }}"  <?php if($cat_list->id == $subCat->cat_id){ echo "Selected"; }?>>{{$cat_list->category_name}}</option>
											 <?php } }?>	
											</select>
											@if ($errors->has('category_id'))
                                          <span class="text-danger">{{ $errors->first('category_id') }}</span>
                                         @endif
										</div>
										 
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="sub_cat_name">Sub Category Name </label>
											<input type="text" name="sub_cat_name" value="{{ old('sub_cat_name', $subCat->name) }}" class="form-control" id="sub_cat_name" placeholder="Enter Category Name"> 
										@if ($errors->has('sub_cat_name'))
                                          <span class="text-danger">{{ $errors->first('sub_cat_name') }}</span>
                                         @endif
										</div>
										 
									</div>
									
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="sub_cat_image">Sub Category Image </label><br>
											<img src="{{url('storage/app/subcategory_images')}}/{{$subCat->image}}" width="80px;" height="80px;">
											<input type="hidden" name="sub_old_image" value="{{$subCat->image}}"><br><br>
											<input type="file" name="sub_cat_image" class="form-control" id="sub_cat_image" placeholder="Enter Sub Category Image"> 
										 @if ($errors->has('sub_cat_image'))
                                          <span class="text-danger">{{ $errors->first('sub_cat_image') }}</span>
                                         @endif
										</div>
									    
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="name">Status</label>
											<select name="status" class="form-control">
											  
												<option value="1"  {{ ((old('status') == 1 ) || ( $subCat->status == 1)) ? 'selected' : ''}}>Active</option>
												<option value="2" {{ ((old('status') === "2")  || ($subCat->status == 2 )) ? 'selected' : ''}}>Inactive</option>
												
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
        category_id :{
            required: true,
        },
        sub_cat_name: {
            required: true,
            alpha: true
        },
        status: {
            required: true,
        },
        sub_cat_image : {
           
            accept:"jpg,png,jpeg"
        },
    },
    messages: {
      category_id:{
         required: "Please enter a category name",  
      },    
      sub_cat_name: {
        required: "Please enter a sub category name",
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