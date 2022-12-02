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
            <h3 class="card-title">Assign Role of Sub Admin</h3>
             <div class=" ml-auto w-75 text-right ">
                
             </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
              <form action="{{ url('admin/sub-admin/update-role/')}}" method="post">
                  @csrf
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>S.No.</th>
                <th>Module</th>
                <th>role</th>
            
              </tr>
              </thead>
              <tbody>
              <?php if($listing){ $i=1; foreach($listing as $val){?>      
              <tr>
                <td><input type="hidden" name="m_id[]" value="{{ $val->id}}" >{{  $i }}</td>
                
                
                <td><input type="hidden" name="admin_id[]" value="{{ $val->admin_id }}" >{{ $val->name }}</td>
                <td>
                    <select name="role[]">
                        <option value="0" <?php if($val->role == 0){ echo "Selected";}?> >No Role</option>
                        <option value="1" <?php if($val->role == 1){ echo "Selected";}?>> view </option>
                        <option value="2" <?php if($val->role == 2){ echo "Selected";}?>> View/Edit</option>
                    </select>
                </td>
              </tr>
              <?php $i++; }}?>
              </tbody>
             
            </table>
            <input type="submit" name="submit" value="update" class="btn btn-primary">
            </form>
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