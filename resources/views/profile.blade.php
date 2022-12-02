@extends('app')

@section('content')
<div class="content-wrapper">
   <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-10">   
            <h1 class="m-0">My Profile</h1>
          </div><!-- /.col -->
         <div class="col-sm-2 text-right">
          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#changePwdModal">
            Change Password
          </button>
            <!-- <a class="btn btn-success" href="change-password.html"> </a> -->
          </div> <!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
 <div class="modal fade" id="changePwdModal" style="display: none;" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Change Password</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
             @if(Session::has('error'))
               <div class="text text-danger">{{Session::get('error') }}</div>
               @endif
          </div>
          <form action="{{url('admin/profile/changepass')}}" method="POST"  id="changepassword1">
              @csrf
            <div class="modal-body">
             <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <div class="d-flex justify-content-between">
                    <label> Old Password</label>
                    <!--<a class="" href="forgot-pwd.html"> <small>Forgot Password? </small></a>-->
                  </div>
                  
                  <input type="password" name="old_password" class="form-control" required placeholder="Enter old password">
                </div>
                    @error('old_password')
               <div class="text text-danger">{{ $message }}</div>
               @enderror
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label> New Password</label>
                  <input type="password" class="form-control" name="password" required placeholder="Enter new password">
                </div>
                    @error('password')
               <div class="text text-danger">{{ $message }}</div>
               @enderror
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>New Confirm Password</label>
                  <input type="password" class="form-control" name="password_confirmation" required  placeholder="New Confirm password">
                </div>
                    @error('password_confirmation')
               <div class="text text-danger">{{ $message }}</div>
               @enderror
              </div>
            </div>
            </div>
               @if(Session::has('error_ee'))
               <div class="text text-danger">{{session('error_ee')}} </div>
                @endif
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Update Password</button>
            </div>
           
            
          </form>
          
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card">
          <div class="invent-header d-flex justify-content-between align-items-center">
            <label class="card-title m-0"> </label>
            <button class="btn btn-info edit_details"><i class="fa fa-edit"></i>  Edit Details</button>
          </div>
          <div class="card-body">
            <form class="profile_form"  id="quickForm" method="POST" action="{{url('admin/profile')}}" enctype='multipart/form-data'>
                @csrf
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Profile Image</label>
                    <input type="hidden" name="old_profile" value="{{$profile->profile_image}}">
                    <input type="file" name="profile_image" class="form-control" id="profile_image" > 
                   
                  </div>
                  @error('profile_image')
               <div class="text text-danger">{{  $errors->first('profile_image') }}</div>
               @enderror
                </div>
              <div class="col-md-6">
                  <input type="hidden" name="id" value="{{$profile->id}}">
                <div class="form-group">
                  <label> Name </label>
                  <input class="form-control" type="text" value="{{old('full_name',$profile->username)}}" name="full_name" disabled>
                </div>
                 @error('full_name')
               <div class="text text-danger">{{ $message }}</div>
               @enderror
              </div>
             
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                      <label> Email </label>
                    <input class="form-control" type="email" name="email" value="{{old('email',$profile->email)}}" disabled>
                  </div>
                  @error('email')
               <div class="text text-danger">{{ $message }}</div>
               @enderror
                 </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label> Mobile </label>
                  <input class="form-control" type="number" name="mobile_no" value="{{old('mobile_no',$profile->mobile_no)}}" disabled>
                  </div>
                  @error('mobile_no')
               <div class="text text-danger">{{ $message }}</div>
               @enderror
                </div>
                
              </div>
            

              <div class="row save_div" style="display: none;">
                <div class="col-md-6">
                  <button type="button" class="btn btn-danger cancel"> Cancel</button>
                </div>
                <div class="col-md-6 text-right">
                  <button type="submit" class="btn btn-success"> Save Changes</button>
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