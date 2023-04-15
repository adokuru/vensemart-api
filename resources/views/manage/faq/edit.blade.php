
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
							<h3 class="card-title">Edit FAQ</h3> </div>
						<!-- /.card-header -->
						<!-- form start -->
				 <form role="form" method="post"   id="quickForm1" action="{{ url('admin/faq/edit').'/'.$listing->id }}" id="reused_form">
         @csrf
          <div class="row">
                <div class="col-sm-6 form-group">
                    <label for="questions">
                        Question :</label>
                    <textarea class="form-control" type="textarea" name="question" required id="questions" maxlength="6000" rows="7">{{$listing->question}}</textarea>
                </div>
                <div class="col-sm-6 form-group">
                    <label for="answers">
                      Answer :</label>
                    <textarea class="form-control" type="textarea" name="answer" required id="answers" maxlength="6000" rows="7">{{$listing->answer}}</textarea>
                </div>
            </div>
            
        


            <div class="row">
                <div class="col-sm-12 form-group">
                    <button type="submit" id="sub" class="btn btn-lg btn-default pull-right">update </button>
                </div>
            </div>

        
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
      question: {
        required: true,
        
      },
      answer: {
        required: true,
      },
     
    },
    messages: {
      question: {
        required: "Please enter a question",
       // lettersonly: "only  name"
      },
      answer: {
        required: "Please provide a answer",
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