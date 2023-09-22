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
            <h3 class="card-title">Bank Details</h3>
             <div class=" ml-auto w-75 text-right ">
                <a href="{{url('admin/new-user/import-user')}}" class="btn btn-primary btn-sm px-4">Import User</a>
                <!--<a href="{{url('admin/new-user/add')}}" class="btn btn-primary btn-sm px-4"> Add</a>-->
             </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>S.No.</th>
                <th>User Id</th>
                <th>Rider Name</th>
                <th>Bank Name</th>
                <th>Branch</th>
               <th>Account Number</th>
                
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
              <?php if($listing){ $i=1; foreach($listing as $val){?>  
                
                
              <tr>
                <td>{{  $i }}</td>
                <td>{{ $val->user_id ?? 'N/A' }}</td>
                <td>{{ $val->account_holder_name ? $val->account_holder_name : 'N/A' }}</td>
                 <td>{{ $val->bank ? $val->bank : 'N/A' }}</td>
                  <td>{{ $val->branch ? $val->branch : 'N/A' }}</td>
                  <td>{{ $val->account_number ? $val->account_number : 'N/A' }}</td>
               
                
               
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
</script>
@stop