
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
							<h3 class="card-title">Add City</h3> </div>
						<!-- /.card-header -->
						<!-- form start -->
						<form id="quickForm" action="{{  url('admin/cities/add')}}" method="post" enctype="multipart/form-data">
							@csrf
							<div class="card-body">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="name">Country</label>
										   <select name="country" class="form-control countries" >
										       <option value="">Choose the Country</option>
										       <?php
										          $country=DB::table('countries')->where('status','1')->get();
										          if(!empty($country[0]))
										          {
										              foreach($country as $val){
										              ?>
										              <option value="{{$val->id}}">{{$val->country_name}}</option>
										              <?php
										          }}
										       ?>
										   </select>
										   
										@if ($errors->has('country'))
                                          <span class="text-danger">{{ $errors->first('country') }}</span>
                                         @endif
										</div>
										 
									</div>
									
									
									<div class="col-md-6">
										<div class="form-group">
											<label for="name">State</label>
										   <select name="state" class="form-control" id="stateing">
										       <option value="">Choose the State</option>
										       
										   </select>
										   
										@if ($errors->has('state'))
                                          <span class="text-danger">{{ $errors->first('state') }}</span>
                                         @endif
										</div>
										 
									</div>
									
									<div class="col-md-6">
										<div class="form-group">
											<label for="name">City Name </label>
											<input type="text" name="cityname" value="{{ old('name') }}" class="form-control" id="name" placeholder="Enter City Name"> 
										@if ($errors->has('cityname'))
                                          <span class="text-danger">{{ $errors->first('cityname') }}</span>
                                         @endif
										</div>
										 
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="name">Status</label>
											<select name="status" class="form-control">
											  
												<option value="1"  {{ (old('status') == 1) ? 'selected' : ''}}>Active</option>
												<option value="2" {{old('status') === "2" ? 'selected' : ''}}>Inactive</option>
												
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

 $(document).on('change','.countries',function(){
     var value=$(this).val();
     $.ajax({
        url:"{{url('admin/state_list')}}/"+value,
        method:"GET",
        data:{id:value},
        dataType:"JSON",
        success:function(data)
        {
            var html="";
            $.each(data,function(key,value){
                html+="<option value="+value.id+">"+value.state_name+"</option>";
            });
            $("#stateing").html(html);
        }
     });
 });


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