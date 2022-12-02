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
            <h3 class="card-title">Out of stock Product  Listing</h3>
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
                <th>category</th>
                <th>Item</th>
                <th>Qty</th>
                <th>price</th>
                <th>U.o.m.</th>
                <th>Image</th>
              
                <th>Add</th>
              </tr>
              </thead>
              <tbody>
              <?php if($listing){ $i=1; foreach($listing as $val){?>      
              <tr>
                <td>{{  $i }}</td>
                <td>{{ $val->name }}</td>
                <td>{{ $val->category->name }}</td>
                <td>{{ $val->subcategory->sub_cat_name }}</td>
                <td>{{$val->quantity }}</td>
                 <td>{{$val->price }}</td>
                <td> {{ $val->uom->name }}</td>
                <td> <?php if($val->image){?>
                    <img src="{{  url('uploads/product_image').'/'. $val->image }}"  width="30" height="30">
                    <?php } ?>
                </td>
             
                <td>
                    <a data-toggle="modal" data-id="{{$val->id}}" title="Add this item" class="open-AddBookDialog" href="#addBookDialog"><i class="fas fa-plus"></i></a>
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
    

<div class="modal" tabindex="-1" role="dialog" id="addBookDialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <form method="post" action="{{ url('admin/inventory/add_qty') }}">
           @csrf
      <div class="modal-body">
         
              <input type="hidden" name="bookId" id="bookId" value=""/>
              <div class="forn-group">
                  <level>Add Quantity</level>
                  <input type="number" name="qty" class="form-control">
              </div>
      
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">add qty</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
          </form>
    </div>
  </div>
</div>
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
<script>
    $(document).on("click", ".open-AddBookDialog", function () {
     var myBookId = $(this).data('id');
     $(".modal-body #bookId").val( myBookId );
     // As pointed out in comments, 
     // it is unnecessary to have to manually call the modal.
     // $('#addBookDialog').modal('show');
});
</script>
@stop