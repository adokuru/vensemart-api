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
            <h3 class="card-title">New Sales Person Listing</h3>
             <div class=" ml-auto w-75 text-right ">
                <a href="{{url('admin/sales-person/import-file')}}" class="btn btn-primary btn-sm px-4"> Import Excel</a> 
                <a href="{{url('admin/sales-person/add')}}" class="btn btn-primary btn-sm px-4"> Add</a>
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
                <th>Image</th>
                <th>Is Verify</th>
                <th>Status</th>
                
                <th>Action</th>
                <th>Agent</th>
              </tr>
              </thead>
              <tbody>
              <?php if($listing){ $i=1; foreach($listing as $val){?>      
              <tr>
                <td>{{  $i }}</td>
                <td>{{ $val->name }}</td>
                <td>{{ $val->email }}</td>
                <td>{{ $val->mobile }}</td>
                <td> <?php if($val->image){?>
                    <img src="{{  url('uploads/user_images').'/'. $val->image }}"  width="30" height="30">
                    <?php } ?>
                </td>
                <td>
               <select onchange="change_status(<?php echo $val->id;?>,this)">
                   <?php if($val->is_approved == "0" ){ ?>
                   <option value="0" <?php if($val->is_approved == "0"){ echo "Selected";}?> > <a href="#heading1">Pending</a></option>
                   <?php } ?>
                   <option value="1" <?php if($val->is_approved == "1"){ echo "Selected";}?> >  <a href="#heading1">Approved </a></option>
                   <?php if($val->is_approved != "1" ){ ?>
                   <option value="2" <?php if($val->is_approved == "2"){ echo "Selected";}?> >  <a href="#heading1">Disapproved</option>
                  <?php } ?>
               </select>
               </td>
                <td><?php if($val->status == 1){ ?>
                      <span class="badge badge-success">Active</span>
                <?php }else { ?>
                      <span class="badge badge-danger">InActive</span>
               <?php  } ?></td>
                <td>
                    <a href="{{url('admin/sales-person/edit').'/'.$val->id }}" title="Edit"><i class="fas fa-edit"></i></a> |
                    <a href="{{url('admin/sales-person/delete').'/'.$val->id }}" title="Delete"><i class="fas fa-trash"></i></a> |
                    <a href="{{url('admin/sales-person/manage-price').'/'.$val->id }}" title="Manage Cart Price"><i class="fas fa-cart-plus"></i></a>
                </td>
                <td>
                   <a href="{{url('admin/sales-agent/add').'?sales='.$val->id }}" title="Add Agent"><i class="fas fa-plus"></i></a> | 
                   <a href="{{url('admin/sales-agent/listing').'?sales='.$val->id }}" title="View Agent"><i class="fa fa-eye" aria-hidden="true"></i></a> 
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
    //   "responsive": false, "lengthChange": false, "autoWidth": true,
    //   "buttons": ["csv", "excel", "pdf", "print"]
    // }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
  $(document).ready( function () {
    $('#example1').DataTable();
} );
</script>

<script>
    function change_status(d_id,a){
        var is_approved  =a.value;
      
          $.ajax({

            type: "get",

            dataType: "json",

            url: '{{ url('admin/seles-person/change_status_of_seles') }}',

            data: {'is_approved': is_approved, 'd_id': d_id},

            success: function(data){
              //  console.log(data);
           location.reload();
            }

        });
    }
</script>
@stop