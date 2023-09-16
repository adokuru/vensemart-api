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
            <h3 class="card-title">Existing User Listing</h3>
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
                <th>Email</th>
                <th>mobile</th>
                <th>Image</th>
                <th>Status</th>
                <th>Registered</th>
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
                <td>{{ $val->referred_by_id }}</td>
                
                <td> <?php if($val->profile){?>
                    <img src="{{  url('storage/uploads/profile').'/'. $val->profile }}"  width="50" height="50">
                    <?php }else
                    {
                        ?>
                        <img src="{{url('uploads/profile')}}/noimageavailable.jpg" width="50" height="50">
                        <?php
                    }
                    ?> 
                </td>
                <td><?php if($val->status == 1){ ?>
                      <span class="badge badge-success">Active</span>
                <?php }else { ?>
                      <span class="badge badge-danger">InActive</span>
               <?php  } ?></td>

               <td>  {{ \Carbon\Carbon::parse($val->created_at)->diffForHumans() }}</td>
                <td>
                    <!--<a href="{{url('admin/existinguser/edit').'/'.$val->id }}"><i class="fas fa-edit"></i></a> |-->
                    <a href="{{url('admin/existinguser/delete').'/'.$val->id }}"><i class="fas fa-trash"></i></a>
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
  
  $(document).ready(function(){
     
     $(document).on('click','.existingdelete',function(){
         console.log('sdfas'); return false;
        var id=$(this).attr('data-id');
        console.log(id); 
        
        var result=confirm("Do you want to delete this user");
        if(result=="yes")
        {
             $.ajax({
               url:"{{url('admin/existinguser/delete')}}",
               method:'GET',
               data:{id:id},
               dataType:'json',
               success:function(data)
               {
                   
               }
            });
        }
       
     });
  });
</script>
@stop