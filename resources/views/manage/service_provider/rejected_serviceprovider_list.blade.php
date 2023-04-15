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
            <h3 class="card-title">Rejected Service Provider Listing</h3>
             <div class=" ml-auto w-75 text-right ">
                <!--<a href="{{url('admin/new-driver/add')}}" class="btn btn-primary btn-sm px-4"> Add </a>-->
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
                <th>Status</th>
             
                <th>Is Verify</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
              <?php if($listing){ $i=1; foreach($listing as $val){?>      
              <tr>
                <td>{{  $i }}</td>
                <td>{{ $val->name }}</td>
                <td>{{ $val->email }}</td>
                <td>{{ $val->mobile }}</td> 

                <td> <?php if($val->id_prof){?>
                    <img src="{{  url('uploads/id_prof').'/'. $val->id_prof }}"  width="30" height="30">
                    <?php } ?>
                </td>
            
               
               <<td><?php if($val->documents_approved == 3){ ?>
                      <span class="badge badge-danger"><i class="fa fa-close" aria-hidden="true"> Rejected</i></span>
                <?php }else { ?>
                      <span class="badge badge-danger"><i class="fa fa-close">Disapproved</i></span>
               <?php  } ?></td>
         
                <td>
                   
                    <select onchange="change_status_exist(<?php echo $val->id;?>,this)">
                       <option value="2" <?php if($val->documents_approved == 2){ echo "Selected";}?> > Approved </option>
                       <option value="1" <?php if($val->documents_approved == 1){ echo "Selected";}?> >  Not Approved</option>
                      <option value="3" <?php if($val->documents_approved == 3){ echo "Selected";}?> >  Rejected</option>
                   </select>
               </td>
                <td>
                    <a href="{{url('admin/managerejectedservice_provider/view').'/'.$val->id }}"><i class="fa fa-eye" aria-hidden="true"></i></a> |
                    <!--<a href="{{url('admin/new-driver/edit').'/'.$val->id }}"><i class="fas fa-edit"></i></a> |-->
                    <a href="{{url('admin/managerejectedservice_provider/delete').'/'.$val->id }}"><i class="fas fa-trash"></i></a>
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
  
  

    function change_status_exist(d_id,a){
        var status_val  =a.value;
        // console.log(a.value); return false;
          $.ajax({

            type: "GET",

            dataType: "json",

            url: '{{ url('admin/rejectedservice_provider/change_status_of_rejectedserviceprovider') }}',

            data: {'status_val': status_val, 'd_id': d_id},

            success: function(data){
              //  console.log(data);
            location.reload();
            }

        });
    }

</script>
@stop