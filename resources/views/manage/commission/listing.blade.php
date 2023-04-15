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
            <h3 class="card-title">Commission Listing</h3>
             <div class=" ml-auto w-75 text-right ">
                <a href="{{url('admin/category/add')}}" class="btn btn-primary btn-sm px-4"> Add</a>
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
                <th>Commission Amount</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
              <?php if(count($listing) > 0){ $i=1; foreach($listing as $val){?>      
              <tr>
                <td>{{  $i }}</td>
                <td>{{ $val->name }}</td>
                <td>
                   {{ $val->email }}
                </td>
                <td>{{ ($val->sales_commission ) ? $val->sales_commission : 0 }}</td>
                <td>
                    <a href="{{url('admin/commission/view-detail').'/'. $val->id}}">view all</a>

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
  
  <div class="modal" tabindex="-1" role="dialog" id="addBookDialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Commission</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <form method="post" action="{{ url('admin/commission/updated') }}">
           @csrf
      <div class="modal-body">
         
              <input type="hidden" name="com_id" id="bookId" value=""/>
              <div class="forn-group">
                  <level>update commission</level>
                  <input type="number" name="commission" id="commis" class="form-control">
              </div>
      
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">update commission</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
          </form>
    </div>
  </div>
</div>


 <div class="modal" tabindex="-1" role="dialog" id="addBookDialog2">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Commission</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <form method="post" action="{{ url('admin/commission/add') }}">
           @csrf
      <div class="modal-body">
         
              <input type="hidden" name="bookId" id="bookId" value=""/>
              <div class="forn-group">
                  <level>Add commission</level>
                  <input type="number" name="commission"  id="commisa" class="form-control">
              </div>
      
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">add commission</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
          </form>
    </div>
  </div>
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

<script>
    $(document).on("click", ".open-AddBookDialog", function () {
     var myBookId = $(this).data('id');
     var commiId = $(this).data('commi');
    
     $(".modal-body #bookId").val( myBookId );
     $(".modal-body #commis").val( commiId );
     // As pointed out in comments, 
     // it is unnecessary to have to manually call the modal.
     // $('#addBookDialog').modal('show');
});
</script>

<script>
    $(document).on("click", ".open-AddBookDialog1", function () {
     var myBookId = $(this).data('id');
     $(".modal-body #bookId").val( myBookId );
     // As pointed out in comments, 
     // it is unnecessary to have to manually call the modal.
     // $('#addBookDialog').modal('show');
});
</script>
@stop