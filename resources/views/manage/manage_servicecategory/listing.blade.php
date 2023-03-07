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
                                <h3 class="card-title">Service Category Listing</h3>
                                <div class=" ml-auto w-75 text-right ">
                                    <a href="{{ url('admin/manageservice_category/add') }}" class="btn btn-primary btn-sm px-4"> Add</a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Name</th>
                                            <th>Image</th>

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
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $val->category_name }}</td>

                                           <td><?php if($val->id > 31){?>
                                            <img src="{{ url('storage/app/category_icons/') }}/{{ $val->category_icon }}" width="150px" height="150px" alt="The image is not found">
                                                <?php } 
                    else
                    {
                                 ?>
                                                <img src="{{ url('storage/category_icons/') }}/{{ $val->category_icon }}" width="150px" height="150px" alt="The image is not found">
                                                <?php
                    }
                    ?>
                                            </td>
                                            <!-- <td><img src="{{ url('storage/category_icons/') }}/{{ $val->category_icon }}" width="150px" height="150px" alt="The image is not found"></td> -->

                                            <td>
                                                <a href="{{ url('admin/manageservice_category/edit') . '/' . $val->id }}"><i class="fas fa-edit"></i></a> |
                                                <a href="{{ url('admin/manageservice_category/delete') . '/' . $val->id }}"><i class="fas fa-trash"></i></a>
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
