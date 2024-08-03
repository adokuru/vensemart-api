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
                            <h3 class="card-title">New Driver Registration Listing</h3>
                            <div class=" ml-auto w-75 text-right ">
                                <!--<a href="{{ url('admin/new-driver/add') }}" class="btn btn-primary btn-sm px-4"> Add </a>-->
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
                                        <th>Registered</th>
                                        <th>Profile</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($listing) {
                                        $i = 1;
                                        foreach ($listing as $val) { ?>
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ $val->name }}</td>
                                                <td>{{ $val->email }}</td>
                                                <td>{{ $val->mobile }}</td>
                                                <td> {{ \Carbon\Carbon::parse($val->created_at)->diffForHumans() }}</td>

                                                <td> <?php if ($val->profile) { ?>
                                                        <img src="{{ url('storage/uploads/profile') . '/' . $val->profile }}" width="30" height="30">
                                                    <?php } ?>
                                                </td>
                                            

                                                <td>

                                                    <select onchange="change_status_exist(<?php echo $val->id; ?>,this)">
                                                        <option value="1" <?php if ($val->status == 1) {
                                                                                echo 'Selected';
                                                                            } ?>> Active </option>
                                                        <option value="0" <?php if ($val->status == 0) {
                                                                                echo 'Selected';
                                                                            } ?>> InActive</option>

                                                    </select>
                                                </td>


                                                <td>

                                                    <!-- <a href="{{ url('admin/new-driver/delete') . '/' . $val->id }}"><i class="fas fa-trash"></i></a> -->
                                                    <a href="{{ url('admin/new-driver/delete') . '/' . $val->id }}"><i class="fas fa-trash"></i></a>

                                                </td>
                                            </tr>
                                    <?php $i++;
                                        }
                                    } ?>
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
    $(function() {
        // $("#example1").DataTable({
        //   "responsive": true, "lengthChange": false, "autoWidth": true,
        //   "buttons": ["csv", "excel", "pdf", "print"]
        // }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });



    function change_status(d_id, a) {
        var status_val = a.value;

        $.ajax({

            type: "GET",

            dataType: "json",

            url: '{{ url('
            admin / new_driver / change_status_of_driver ') }}',

            data: {
                'is_vaify_val': status_val,
                'd_id': d_id
            },

            success: function(data) {
                //console.log(data);
                location.reload();
            }

        });
    }
</script>
@stop