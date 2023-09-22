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
							<h3 class="card-title">Verify store</h3> </div>
						<!-- /.card-header -->
						<!-- form start -->
						<form id="quickForm1" action="{{  url('admin/verify_store')}}" method="post" enctype="multipart/form-data">
							@csrf
						<div class="card-body">
								
							
								<div class="row">
									
								<input type="hidden" name="edit_id" value="{{$user->id}}" class="form-control">
								
									<div class="col-md-6">
										<div class="form-group">
											<label for="name">Status</label>
											<select name="verify_status" class="form-control">
											    <option value="1" @if($user->is_verified == 1) selected @endif >Verified</option>
											    <option value="0" @if($user->is_verified == 0) selected @endif>Not-Verified</option>
												
												
											</select>
										
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

@stop