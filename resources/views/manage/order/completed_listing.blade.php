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
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>S.No.</th>
                <th>order_id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Total Item</th>
                <th>Total Amount</th>
                <th>Payment Status</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
              <?php if($listing){ $i=1; foreach($listing as $val){?>      
              <tr>
                <td>{{  $i }}</td>
                <td>{{ $val->order_id }}</td>
                <td>{{ $val->name ?? ''}}</td>
                <td>{{ $val->email ?? ''}}</td> 
               <td>{{ $val->total_item }}</td>
                <td>{{ $val->total_amount }}</td> 
                 
                 <?php
                   if($val->payment_status=="1")
                   {
                       ?>
                            <td>Pending</td>   
                       <?php
                   }
                 ?>
                 
                 <?php
                   if($val->payment_status=="2")
                   {
                       ?>
                            <td>Processed</td>   
                       <?php
                   }
                 ?>
                 
                 <?php
                   if($val->payment_status=="3")
                   {
                       ?>
                            <td>Success</td>   
                       <?php
                   }
                 ?>
                 
                 <?php
                   if($val->payment_status=="4")
                   {
                       ?>
                            <td>Failed</td>   
                       <?php
                   }
                 ?>
                
                <td>
                    <a href="{{url('admin/order/completed_orders/view_orders').'/'.$val->order_id }}"><i class="fa fa-eye" aria-hidden="true"></i></a> | 
                    <a href="{{url('admin/order/completed_orders/editorders').'/'.$val->order_id }}"><i class="fa fa-edit" aria-hidden="true"></i></a>
                </td>
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