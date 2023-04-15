@extends('app')

@section('content')
<div class="content-wrapper">
   <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-10">   
            <h1 class="m-0">Contact Us</h1>
          </div><!-- /.col -->
         
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
 
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card">
          <div class="invent-header d-flex justify-content-between align-items-center">
            <label class="card-title m-0"> </label>
            <!--<button class="btn btn-info edit_details"><i class="fa fa-edit"></i>  Edit Details</button>-->
          </div>
          <div class="card-body">
            <form class="profile_form"  id="quickForm" method="POST" action="{{url('admin/contactus/update')}}" enctype='multipart/form-data'>
                @csrf
              <div class="row">
                <div class="col-md-6">
                 
                  
              
             
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                      <label> Email </label>
                    <input class="form-control" type="email" name="email" value="{{$contactus->email}}" >
                  </div>
                  
                 </div>
              </div>
              
              <div class="row">
                <div class="col-md-12">
                      <div class="form-group">
                        <label> Mobile </label>
                      <input class="form-control" type="text" name="mobile_no" value="{{$contactus->mobile}}" >
                      </div>
                  </div>
              </div>
            

              <div class="row save_div" >
                <div class="col-md-6">
                 <button type="submit" class="btn btn-success"> Save Changes</button>
                </div>
                <div class="col-md-6 text-right">
                  <!--<button type="submit" class="btn btn-success"> Save Changes</button>-->
                </div>
              </div>
              </form>
            
          </div>
        </div>

      </div><!-- /.container-fluid -->
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
      full_name: {
        required: true,
        alpha: true
      },
      email: {
        required: true,
        email: true,
      },
       mobile_no: {
        required: true,
         minlength : 10,
         maxlength : 10
      },
     
    
     profile_image : {
       
        accept:"jpg,png,jpeg"
      },
    },
    messages: {
      full_name: {
        required: "Please enter a  name",
       // lettersonly: "only  name"
      },
      email: {
        required: "Please enter a email address",
        email: "Please enter a vaild email address"
      },
     
      mobile_no :{
        required: "Please enter a mobile number", 
        minlength : 'mobile number must be 10 digit',
        maxlength : 'mobile number must be 10 digit'
      },
      profile_image:{
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


<script>
  // For edit profile
  $(".edit_details").click(function(){
    $(this).hide();
    $(".save_div").show();
    $(".profile_form").find("input").removeAttr("disabled");
    $(".profile_form").find("textarea").removeAttr("disabled");
  });
  $(".cancel").click(function(){
    $(".save_div").hide();
    $(".edit_details").show();
    $(".profile_form").find("input").attr("disabled", "disabled");
    $(".profile_form").find("textarea").attr("disabled", "disabled");
  });
</script>

<script>
    
    @if(Session::has('error_ee'))
  		 $('#changePwdModal').modal('show');
  @endif
   @error('password')
  		 $('#changePwdModal').modal('show');
  @enderror
</script>
@stop