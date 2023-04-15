@extends('app')

@section('content')
 <div class="content-wrapper">
   

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
           
            <!-- /.card -->

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Completed Order Listing</h3>
             <div class=" ml-auto w-75 text-right ">
             
             </div>
          </div>
          <style>
              td, th {
           user-select: none;
          -webkit-user-select: none;
          -moz-user-select: -moz-none;
          -ms-user-select: none; 
        }
          </style>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>S.No.</th>
                <th>booking_id</th>
                <th>Name</th>
                <!-- <th>Email</th> -->
               <th>Booking Time</th>
                <th>Booking Date</th>
                <!-- <th>Payment Status</th>
                <th>Order Status</th> -->
                
                <!-- <th>Action</th> -->
              </tr>
              </thead>
              <tbody>
              <?php if($listing){ $i=1; foreach($listing as $val){?>      
              <tr>
                <td>{{  $i }}</td>


                <td>{{ $val->booking_id }}</td>
                <td>{{ $val->user_name ?? 'JackWorker'}}</td>
                <!-- <td>{{ $val->user_id ?? ''}}</td> -->
                <!-- <td>{{ $val->user_email ?? ''}}</td> -->

                <!-- <td>{{ $val->price ?? ''}}</td> -->
                <td>{{ $val->booking_time ?? 'No Time' }}</td>
                <td>{{ $val->booking_date  ?? 'No Date' }}</td>

                <!-- <td>{{ $valprice ?? ''}}</td> -->
               
               
              </tr>
              <?php $i++; }}?>
              </tbody>
             
            </table>
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
  
  

    function change_status(d_id,a){
        var status_val  =a.value;
     
          $.ajax({

            type: "GET",

            dataType: "json",

            url: '{{ url('admin/new_driver/change_status_of_driver') }}',

            data: {'is_vaify_val': status_val, 'd_id': d_id},

            success: function(data){
                //console.log(data);
            location.reload();
            }

        });
    }

</script>
@stop