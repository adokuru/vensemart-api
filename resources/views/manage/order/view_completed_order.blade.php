@extends('app')

@section('content')
    <div class="content-wrapper">


        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <!-- /.card -->

                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title">View Order Details</h3>
                            </div>
                            <div class="card-body" style="overflow-x: scroll">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="d-flex w-100 justify-content-start">
                                            <label>Order Id:</label>

                                            <p class="ml-2">{{ $order->order_id }}</p>

                                            <!-- /.input group -->
                                        </div>
                                    </div>
                                    <div>


                                        <div class="d-flex w-100 justify-content-start">
                                            <label>Amunt:</label>


                                            <p class="ml-2">{{ $order->total_amount }}</p>

                                            <!-- /.input group -->
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="d-flex w-100 justify-content-start">
                                            <label>booking Date:</label>
                                            <div class="input-group">
                                                <p class="ml-2">{{ $order->order_date }}</p>
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-12">
                                        <div class="d-flex w-100 justify-content-start">
                                            <label>Status :</label>
                                            <div class="input-group">
                                                <p class="ml-2">{{ $order->payment_type }}</p>
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-12">


                                        <div class="d-flex w-100 justify-content-start">
                                            <div class="col-lg-6"><label>User Name:</label></div>

                                            <div class="col-lg-6">
                                                <div class="input-group">
                                                    <p class="ml-2">{{ $username->name }}</p>
                                                </div>
                                            </div <!-- /.input group -->
                                        </div>


                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <div class="d-flex w-100 justify-content-start">
                                            <div class="col-lg-6"><label>Delivered By:-</label></div>

                                            <div class="col-lg-6">
                                                <div class="input-group">
                                                    <p class="ml-2">{{ $driverdetails->name }}</p>
                                                </div>
                                            </div>
                                            <!-- /.input group -->
                                        </div>

                                    </div>

                                    <div class="col-lg-4 col-12">
                                        <div class="d-flex w-100 justify-content-start">
                                            <div class="col-lg-6"><label>Driver Email Id:-</label></div>

                                            <div class="col-lg-6">
                                                <div class="input-group">
                                                    <p class="ml-2">{{ $driverdetails->email }}</p>
                                                </div>
                                            </div>
                                            <!-- /.input group -->
                                        </div>

                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <div class="d-flex w-100 justify-content-start">
                                            <div class="col-lg-6"><label>Driver Mobile:-</label></div>

                                            <div class="col-lg-6">
                                                <div class="input-group">
                                                    <p class="ml-2">{{ $driverdetails->mobile }}</p>
                                                </div>
                                            </div>
                                            <!-- /.input group -->
                                        </div>

                                    </div>

                                </div>

                                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6"></div>
                                        <div class="col-sm-12 col-md-6"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="example1" class="table table-bordered table-striped dataTable no-footer" role="grid" aria-describedby="example1_info">
                                                <thead>
                                                    <tr role="row">
                                                        <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Part Number: activate to sort column descending">S.No</th>

                                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Product Name: activate to sort column ascending">Product Name</th>
                                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Category Name: activate to sort column ascending">Product Image</th>
                                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Brand Name: activate to sort column ascending">Quantity</th>
                                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Quantity: activate to sort column ascending">UOM</th>
                                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Unit Price: activate to sort column ascending">Unit Price</th>
                                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Total Price: activate to sort column ascending">Total Price</th>
                                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="discounted Price: activate to sort column ascending">discounted Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody>


                                                    <?php if($order_detail){ $i =1;;
                 foreach($order_detail as $k =>$value){
                 ?>
                                                    <tr>

                                                        <td class="sorting_1">{{ $i }}</td>
                                                        <td>{{ $value->product_name }}</td>
                                                        <td><img src="{{ url('storage/product_images') }}/{{ $value->p_image }}" width="50px;" height="50px;"></td>
                                                        <td>{{ $value->quantity }}</td>
                                                        <td>{{ $value->uom_name }}</td>
                                                        <td>{{ $value->net_price }}</td>
                                                        <td>{{ $order->total_amount }}</td>
                                                        <td>{{ $value->dp }}</td>

                                                    </tr>
                                                    <?php } }?>
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="card-footer">
                                <div class="d-flex w-100 justify-content-start">
                                    <a href="javascript:window.history.go(-1);" class="btn btn-info">Go Back</a>
                                    <!-- /.input group -->
                                </div>
                            </div>
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
        $(function() {
            // $("#example1").DataTable({
            //   "responsive": true, "lengthChange": false, "autoWidth": true,
            //   "buttons": ["csv", "excel", "pdf", "print"]
            // }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
@stop
