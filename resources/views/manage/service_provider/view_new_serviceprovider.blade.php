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
                <h3 class="card-title">View of New Service Provider</h3>
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
                     <span>Is Approved</span> <?php if($listing->documents_approved == 2){?> <span class="badge badge-info"> Approved</span> 
                      <?php }?>
                </li>
                <h6>ID Proof</h6>
                <img src="{{  url('uploads/id_prof').'/'. $listing->id_prof }}" height="200" width="200">
                </ul>
                </div>   
                  
                <div class="col-md-6">
              
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