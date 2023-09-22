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
                <th>Vendor Name</th>
                <th>Bank Name</th>
                <th>Account Name</th>
               <th>Account Number</th>
                <!-- <th>Image</th>
                <th>store Verified</th> -->
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
              <?php if($listing){ $i=1; foreach($listing as $val){?>  
                
                
              <tr>
                <td>{{  $i }}</td>
                <td>{{ $val->user_id ?? 'N/A' }}</td>
                <td>{{ $val->username ?? 'N/A' }}</td>
                 <td>{{ $val->bank_nm ?? 'N/A' }}</td>
                  <td>{{ $val->acc_name ?? 'N/A' }}</td>
                  <td>{{ $val->ac_no ?? 'N/A' }}</td>
                <!-- <td>{{ $val->telephone }}</td> -->
                
                <td><?php if($val->is_verified == 1){ ?>
                      <span class="badge badge-success">Verified</span>
                <?php }else { ?>
                      <span class="badge badge-danger">Not-Verified</span>
               <?php  } ?></td>
                <td>
                    <a href="{{url('admin/edit-store').'/'.$val->id }}"><i class="fas fa-edit"></i></a> |

                   
                    <a href="{{url('admin/existingstore/delete').'/'.$val->id }}" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fas fa-trash"></i></a>
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