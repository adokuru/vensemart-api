@extends('Admin/app')

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
            <h3 class="card-title">Customer Query Listing</h3>
             <div class=" ml-auto w-75 text-right ">
               
             </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>S.No.</th>
                <th>Name</th>
                <th>Query</th>
                <th>Reply</th>
                <th>Action</th>
           
              </tr>
              </thead>
              <tbody>
              <?php if($c_query){ $i=1; foreach($c_query as $val){?>      
              <tr>
                <td>{{  $i }}</td>
                <td>{{ $val->user->name ?? '' }}</td>
                <td>{{ $val->customer_query }}</td>
                <td>{{ $val->customer_reply }}</td>
                <td>
                    @if($val->customer_reply == null)
                 <a href="{{url('admin/customer-query/reply').'/'.$val->id }}"><i class='fa fa-reply-all'></i></a> 
                 @endif
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
//   $(function () {
//     $("#example1").DataTable({
//       "responsive": true, "lengthChange": false, "autoWidth": true,
//       "buttons": ["csv", "excel", "pdf", "print"]
//     }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
//   });
</script>


@stop