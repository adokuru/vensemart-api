@extends('app')

@section('content')
 <div class="content-wrapper">
   

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
           
            <!-- /.card -->

     <div class="card ">
   <div class="card-header d-flex align-items-center">
      <h3 class="card-title">Manage About-us</h3>
     
   </div>
   <!-- /.card-header -->
   <!-- form start -->
  
     
      <div class="card-body">
          
         <div class="row">
    <div class="col-md-12 m-auto" id="form_container">
      
        <form role="form" method="post"   id="quickForm1" action="{{ url('admin/about-us/update') }}" id="reused_form">
         @csrf
          <div class="row">
                <div class="col-sm-12 form-group">
                    <label for="message">
                        Discription :</label>
                         <textarea class="form-control" type="textarea" name="description" id="message" maxlength="6000" rows="7">{{$about->description}}</textarea>
                 
                </div>
             
            </div>
            
          


            <div class="row">
                <div class="col-sm-12 form-group">
                    <button type="submit" id="sub" class="btn btn-lg btn-default pull-right">update</button>
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
          <!-- /.col -->
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
 
  $('#quickForm1').validate({
    rules: {
     
   description: {
		  required: true,
		 
		
		},
  
    },
    messages: {
      description: {
        required: "Please enter a description",
      },
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