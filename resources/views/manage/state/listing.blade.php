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
            <h3 class="card-title">States Listing</h3>
             <div class=" ml-auto w-75 text-right ">
                <a href="{{url('admin/states/add')}}" class="btn btn-primary btn-sm px-4"> Add</a>
             </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>S.No.</th>
                <th>Country Name</th>
                <th>State Name</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
              <?php
               if(isset($listing))
               {
                   $i=0;
                   foreach($listing as $val)
                   {
                   ?>
                   <tr>
                        <td>{{++$i}}</td>
                       
                        <td>{{$val->country_name}}</td>   
                         <td>{{$val->state_name}}</td>
                        
                       <?php
                       if($val->status=="1")
                       {
                           ?>
                           <td><span class="badge badge-success">Active</span></td>
                           <?php
                       }
                       ?>
                       <?php
                       if($val->status=="2")
                       {
                           ?>
                           <td><span class="badge badge-danger">Inactive</span></td>
                           <?php
                       }
                       ?>
                       <td>
                            <a href="{{url('admin/states/edit').'/'.$val->id }}"><i class="fas fa-edit"></i></a> |
                            <a href="{{url('admin/states/delete').'/'.$val->id }}"><i class="fas fa-trash"></i></a>
                      </td>
                   </tr>
                   
                   <?php
               }}
              ?>
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