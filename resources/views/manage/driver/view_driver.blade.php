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
            <div class="card-header bg-dark mt-0">
                <h3 class="card-title">Driver Detail</h3>
            </div>
              <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
               <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between">
                    <span>Name </span> <span>{{$listing->name}}</span> 
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Email </span> <span>{{$listing->email}}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Mobile </span> <span>{{$listing->mobile}}</span> 
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Staus </span> <?php if($listing->status == 1){?> <span class="badge badge-success">Active</span> <?php }else{?> <span class="badge badge-danger">InActive</span> <?php } ?>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                     <span>Is Approved</span> <?php if($listing->isVerify == 2){?> <span class="badge badge-info"> Disapproved</span> 
                      <?php }?>
                </li>
                <h6>Profile Image</h6>
                <img src="{{url('uploads/profile').'/'.$listing->profile}}" height="200" width="200">
                </ul>
                </div>   
                  
                <div class="col-md-6">
               <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between">
                    <span>Vehicle Number</span><span>{{$listing->vehicle_number}}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Driver Licence</span><span>{{$listing->dl_number}}</span> 
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Insurance Number</span><span>{{$listing->insurance_number}}</span>
                </li>
                
               
                 <li class="list-group-item d-flex justify-content-between">
                    <h4>Driving License Image</h4>
                    <img src="{{url('uploads/all_image').'/'.$listing->dl_picture}}" height="200" width="200">
                </li>
              <li class="list-group-item d-flex justify-content-between">
                    <h4>Insurance Image</h4>
                    <img src="{{url('uploads/all_image').'/'.$listing->insurance_picture}}" height="200" width="200">
                </li>
                </ul>
                </div> 
                 
               
                     
                </div>
              </div>
              <!-- /.card-body -->
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
    // $("#example1").DataTable({
    //   "responsive": true, "lengthChange": false, "autoWidth": true,
    //   "buttons": ["csv", "excel", "pdf", "print"]
    // }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
@stop