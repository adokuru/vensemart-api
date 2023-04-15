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
            <h3 class="card-title">Sales Agent Listing</h3>
             <div class=" ml-auto w-75 text-right ">
                <!--<a href="{{url('admin/sales-person/add')}}" class="btn btn-primary btn-sm px-4"> Add</a>-->
             </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>S.No.</th>
                <th>Agent Name</th>
                <th>sales Name</th>
                <th>Email</th>
                <th>mobile</th>
                <th>Image</th>
              
                <th>Status</th>
                
                <th>Action</th>
              
              </tr>
              </thead>
              <tbody>
              <?php if($listing){ $i=1; foreach($listing as $val){?>      
              <tr>
                <td>{{  $i }}</td>
                <td>{{ $val->name }}</td>
                <td>{{ $val->seles_name }}</td>
                <td>{{ $val->email }}</td>
                <td>{{ $val->mobile }}</td>
                <td> <?php if($val->image){?>
                    <img src="{{  url('uploads/user_images').'/'. $val->image }}"  width="30" height="30">
                    <?php } ?>
                </td>
              
                <td><?php if($val->status == 1){ ?>
                      <span class="badge badge-success">Active</span>
                <?php }else { ?>
                      <span class="badge badge-danger">InActive</span>
               <?php  } ?></td>
                <td>
                    <a href="{{url('admin/sales-agent/edit').'?sales='.$val->seles_person_id . '&agent='.$val->id}}"><i class="fas fa-edit"></i></a> |
                    <a href="{{url('admin/sales-agent/delete').'?sales='.$val->seles_person_id . '&agent='.$val->id }}"><i class="fas fa-trash"></i></a>
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
//   $(document).ready( function () {
//     $('#example1').DataTable();
//     });
</script>

<script>
    function change_status(d_id,a){
        var status_val  =a.value;
     
          $.ajax({

            type: "GET",

            dataType: "json",

            url: '{{ url('admin/seles-person/change_status_of_seles') }}',

            data: {'is_approved': is_approved, 'd_id': d_id},

            success: function(data){
                console.log(data);
           // location.reload();
            }

        });
    }
</script>
@stop