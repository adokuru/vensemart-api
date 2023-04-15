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
            <h3 class="card-title">Service Provider Withdrawl Request</h3>
             <div class=" ml-auto w-75 text-right ">
                <a href="" class="btn btn-primary btn-sm px-4">Import Requests</a>
                <a href="" class="btn btn-primary btn-sm px-4"> Add</a>
             </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>S.No.</th>
                <th>Name</th>
                <th>Email</th>
                <th>mobile</th>
                
                <th>Amount</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
              <?php if($listing){ $i=1; foreach($listing as $val){?>      
              <tr>
                <td>{{  $i }}</td>
                <td>{{ $val->user_name }}</td>
                <td>{{ $val->user_email }}</td>
                <td>{{ $val->user_mobile }}</td>
                
                
                <td>₹ {{$val->amount}}</td>
                <td>
                    
                    <?php if($val->status == 1){ ?>
                      <span class="badge badge-info">Pending</span>
                    <?php } ?>
                    
                    <?php if($val->status == 2){ ?>
                      <span class="badge badge-success">Accepted</span>
                    <?php } ?>
                    
                    <?php if($val->status == 3){ ?>
                      <span class="badge badge-danger">Rejected</span>
                    <?php } ?>
                    
                    
                    
                    
                </td>
                <td>
                    <a href="{{url('admin/managewithdrawl_request/edit').'/'.$val->id }}"><i class="fas fa-edit"></i></a> |
                    <!--<a href="{{url('admin/new-user/delete').'/'.$val->id }}"><i class="fas fa-trash"></i></a>-->
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
</script>
@stop