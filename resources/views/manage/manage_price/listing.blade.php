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
            <h3 class="card-title"> Manage price ( Seles Person : <?php if(count($cart) > 0) { echo $cart[0]->seles->name;}?> )  </h3>
             <div class=" ml-auto w-75 text-right ">
                
             </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
              
                <th>user Name</th>
              
                <th>product Name</th>
                <th>product Image</th>
                <th>qty</th>
                <th>U.O.M</th>
                <th>price</th>
                <th>Discounted price</th>
                <th>sub Total</th>
                <th>Manage Price</th>
                
              </tr>
              </thead>
              <tbody>
              <?php if($cart){ $i=1; foreach($cart as $val){?>      
              <tr>
                
                <td>{{ $val->user->name }}</td>
              
                <td>{{ $val->product_name }}</td>
                <td> <?php if($val->image){?>
                    <img src="{{  url('uploads/product_image').'/'. $val->image }}"  width="30" height="30">
                    <?php } ?>
                </td>
                <td>{{ $val->qty }}</td>
                <td>{{ $val->uom->name }}</td>
                <td>{{ $val->price }}</td>
                <td>{{ $val->discounted_price }}</td>
                <td>{{ $val->subtotal }}</td>
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
  </div>
  
  <div class="modal" tabindex="-1" role="dialog" id="addBookDialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <form method="post" action="{{ url('admin/manage-price') }}">
           @csrf
      <div class="modal-body">
         
              <input type="hidden" name="cart_id" id="bookId" value=""/>
              <div class="forn-group">
                  <level>update product price </level>
                  <input type="number" name="p_price" class="form-control" required>
              </div>
      
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">update price</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
          </form>
    </div>
  </div>
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
    $(document).on("click", ".open-AddBookDialog", function () {
     var myBookId = $(this).data('id');
     $(".modal-body #bookId").val( myBookId );
     // As pointed out in comments, 
     // it is unnecessary to have to manually call the modal.
     // $('#addBookDialog').modal('show');
});
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