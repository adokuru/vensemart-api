
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
							<h3 class="card-title">Add Inventory</h3> </div>
						<!-- /.card-header -->
						<!-- form start -->
						<form id="quickForm" action="{{  url('admin/inventory/add')}}" method="post" enctype="multipart/form-data">
							@csrf
							<div class="card-body">
								<div class="row">
								   <div class="col-md-6">
										<div class="form-group">
											<label for="name">Select Category</label>
											<select name="cat_id" class="form-control" id="category">
											    <option  >select Category</option>
											    <?php if(count($cat_listing) > 0){ foreach($cat_listing as $key => $val ){?>
												<option value="{{ $val->id }}"  {{ (old('cat_id') == $val->id) ? 'selected' : ''}}>{{ $val->name }}</option>
                                                <?php } } ?>
											</select>
											@if ($errors->has('cat_id'))
                                          <span class="text-danger">{{ $errors->first('cat_id') }}</span>
                                         @endif
										</div>
										 
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="name">Select sub category</label>
											<select name="sub_cat_id" id="subcategory" class="form-control">
												<option value="none" >select sub category</option>
											</select>
											@if ($errors->has('sub_cat_id'))
                                          <span class="text-danger">{{ $errors->first('sub_cat_id') }}</span>
                                         @endif
										</div>
										 
									</div>
								</div>
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
											<label for="email"> price </label>
											<input type="number" name="price" value="{{ old('price') }}" class="form-control" id="price" placeholder="Enter price"> 
    										@if ($errors->has('price'))
                                              <span class="text-danger">{{ $errors->first('price') }}</span>
                                             @endif
										</div>
								    </div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label for="mobile"> Quantity </label>
											<input type="number" name="quantity" value="{{ old('quantity') }}" class="form-control" id="mobile" placeholder="Enter  quantity"> 
    										@if ($errors->has('quantity'))
                                              <span class="text-danger">{{ $errors->first('quantity') }}</span>
                                             @endif
										</div>
								    </div>
								    <div class="col-md-3">
										<div class="form-group">
											<label for="name">Select unit of measurement</label>
											<select name="uom_id" class="form-control" onchange="myFunction()">
											    <option value="none"> select uom</option>
											    <?php if(count($uom_listing) > 0){ foreach($uom_listing as $key => $val1 ){?>
												<option value="{{ $val1->id }}"  {{ (old('uom_id') == $val1->id) ? 'selected' : ''}}>{{ $val1->name }}</option>
                                                <?php } } ?>
											</select>
											@if ($errors->has('uom_id'))
                                          <span class="text-danger">{{ $errors->first('uom_id') }}</span>
                                         @endif
										</div>
								    </div>
								    <div class="col-md-6">
										<div class="form-group">
											<label for="password"> discount </label>
											<input type="number" name="discount" value="{{ old('discount' , "0") }}" class="form-control" id="name" placeholder="Enter discount"> 
    										@if ($errors->has('discount'))
                                              <span class="text-danger">{{ $errors->first('discount') }}</span>
                                             @endif
										</div>
								    </div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="image">Image </label>
											<input type="file" name="image" class="form-control" id="image" placeholder="Enter product Image"> 
										 @if ($errors->has('image'))
                                          <span class="text-danger">{{ $errors->first('image') }}</span>
                                         @endif
										</div>
									    
									</div>
								
									<div class="col-md-6">
										<div class="form-group">
											<label for="name">Status</label>
											<select name="status" class="form-control">
	
												<option value="active"  {{ (old('status') == "active") ? 'selected' : ''}}>Active</option>
												<option value="inactive" {{old('status') === "inactive" ? 'selected' : ''}}>Inactive</option>
												
											</select>
											@if ($errors->has('status'))
                                          <span class="text-danger">{{ $errors->first('status') }}</span>
                                         @endif
										</div>
										 
									</div>
								</div>
								<div class="row">
								    <div class="col-md-6">
										<div class="form-group">
											<label for="image">Sales Commission </label>
											<input type="number" name="sales_commission" value="{{ old('sales_commission' ) }}" class="form-control" id="name" placeholder="Enter sales commission" required> 
										 @if ($errors->has('sales_commission'))
                                          <span class="text-danger">{{ $errors->first('sales_commission') }}</span>
                                         @endif
										</div>
									    
									</div>
								    	<div class="col-md-6">
										<div class="form-group">
											<label for="image">Description </label>
											<textarea class="form-control" id="w3review" name="description" rows="2" cols="50"></textarea>
										 @if ($errors->has('description'))
                                          <span class="text-danger">{{ $errors->first('description') }}</span>
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
  
  $.validator.addMethod("cat_check",function(value, element) {
        if (value == "select Category")  return false;
        else return true;
    }, "Please select a category");
    
     $.validator.addMethod("sub_cat_check",function(value, element) {
        if (value == "none")  return false;
        else return true;
    }, "Please select a sub category");
    
    $.validator.addMethod("uom_check",function(value, element) {
        if (value == "none")
            return false;
        else
            return true;
    }, "Please select a u.o.m.");

  $('#quickForm').validate({
    rules: {
       cat_id:{
           required: true,
           cat_check:true
       },
       sub_cat_id:{
           required: true,
           sub_cat_check:true
       },
      name: {
        required: true,
       //alpha: true
      },
      price: {
        required: true,
         digits: true
      },
      quantity:{
         required: true,
         digits: true  
      },
       uom_id: {
        required: true,
       uom_check:true
      },
     image : {
        required: true,
        accept:"jpg,png,jpeg"
      },
      description:{
         required: true,  
      }
    },
    messages: {
        cat_id:{
           required: "Please select a category",  
        },
        sub_cat_id:{
             required: "Please select a sub category", 
        },
      name: {
        required: "Please enter a name",
       // lettersonly: "only  name"
      },
      price: {
        required: "Please enter a  price",
      
      },
     
      quantity :{
        required: "Please enter a quantity", 
      
      },
      uom_id :{
        required: "Please enter a uom", 
        
      },
      image:{
         required: "Please upload product image",
         accept: "Only image type jpg/png/jpeg is allowed"
      } ,
      description:{
           required: "Please enter a description",
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

<script>
    $(document).ready(function () {
    $('#category').on('change',function(e) {
    var cat_id = e.target.value;
  
       if(cat_id != "select Category"){
            $.ajax({
            url:"{{ url('admin/inventory/get_sub_categor') }}",
            type:"POST",
            data: {
               "_token": "{{ csrf_token() }}","cat_id": cat_id
            },
            success:function (data) {
                    $('#subcategory').empty();
                    if(data.subcategories.length != 0){
                    $.each(data.subcategories,function(index,subcategory){
                       if(subcategory){
                       $('#subcategory').append('<option value="'+subcategory.id+'">'+subcategory.sub_cat_name+'</option>');
                           }else{
                            $('#subcategory').append('<option value="none">No Sub Category</option>');   
                           }
                        })
                     }else{
                        $('#subcategory').append('<option value="none">No Sub Category</option>'); 
                     }
                    }
            })
       }    
    });
});
</script>
@stop