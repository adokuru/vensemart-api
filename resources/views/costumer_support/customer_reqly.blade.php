
@extends('Admin/app')

@section('content')
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<!-- Main content -->
	<section class="content">
      <div class="container-fluid">
       

        <div class="">
          
           
            
              <div class="col-md-12">
<!-- jquery validation -->
<div class="card ">
   <div class="card-header d-flex align-items-center">
      <h3 class="card-title">Reply to feedback emails</h3>
     
   </div>
   <!-- /.card-header -->
   <!-- form start -->
  
     
      <div class="card-body">
          
         <div class="row">
    <div class="col-md-12 m-auto" id="form_container">
        <h2>Replay to Customer</h2>
        <form role="form" method="post" action="{{url('admin/customer-query/reply').'/'.$c_query->id}}  " id="reused_form">
            @csrf
                <div class="row">
                <div class="col-sm-6 form-group">
                    <label for="message">
                        Message :</label>
                    <textarea class="form-control" type="textarea" name="customer_query" id="message" maxlength="6000" rows="7">{{Old('customer_query',$c_query->customer_query)}}</textarea>
                </div>
                <div class="col-sm-6 form-group">
                    <label for="reply">
                        Reply :</label>
                    <textarea class="form-control" type="textarea" name="customer_reply" id="reply" maxlength="6000" rows="7"></textarea>
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-6 form-group">
                    <label for="name">
                        From:</label>
                    <input type="text" class="form-control" id="name" name="name" value="Customer Support" readonly="" required="">
                </div>
                <div class="col-sm-6 form-group">
                    <label for="email">
                        Email:</label>
                    <input type="email" readonly class="form-control" id="email" name="email" value="{{ $c_query->user->email }}" required="">
                </div>
            </div>


            <div class="row">
                <div class="col-sm-12 form-group">
                    <button type="submit" id="sub" class="btn btn-lg btn-default pull-right">Send →</button>
                </div>
            </div>

        </form>
        <div id="success_message" style="width:100%; height:100%; display:none; ">
            <h3> your message has been successfully sent!</h3>
        </div>
        <div id="error_message" style="width:100%; height:100%; display:none; ">
                    <h3>Error</h3>
                    Sorry there was an error sending your form.

        </div>
    </div>
</div>
    
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        
      </div>

</div>

<!-- /.card -->
</div>

              <!-- /.card-body -->
           
            <!-- /.card -->

            <!-- /.card -->

          
        </div>
        <!-- /.row -->
  
      
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