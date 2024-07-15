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
                            <h3 class="card-title">Existing Driver Listing</h3>
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
                                        <th>Image</th>
                                        <th>Is Verify</th>

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


                                                <<td><?php if ($val->isVerify == 1) { ?>
                                                        <span class="badge badge-success"><i class="fa fa-check" aria-hidden="true">
                                                                Approved</i></span>
                                                    <?php } else { ?>
                                                        <span class="badge badge-danger"><i class="fa fa-close">Disapproved</i></span>
                                                    <?php  } ?></td>

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
                                                        <a href="{{ url('admin/existing-driver/view') . '/' . $val->user_idOne }}"><i class="fa fa-eye" aria-hidden="true"></i></a> |
                                                        <!--<a href="{{ url('admin/new-driver/edit') . '/' . $val->id }}"><i class="fas fa-edit"></i></a> |-->
                                                        <a href="{{ url('admin/existing-driver/delete') . '/' . $val->id }}"><i class="fas fa-trash"></i></a>
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


    $(document).ready(function() {

        $(document).on('click', '.existingdelete', function() {
            console.log('sdfas');
            return false;
            var id = $(this).attr('data-id');
            console.log(id);

            var result = confirm("Do you want to delete this driver");
            if (result == "yes") {
                $.ajax({
                    url: "{{ url('admin/existing_driver/delete') }}",
                    method: 'POST', // or 'DELETE' if you're deleting
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(data) {
                        // Handle success
                    },
                    error: function(xhr, status, error) {
                        // Handle errors
                    }
                });
            }

        });
    });


    function change_status_exist(d_id, a) {
        var status_val = a.value;

        $.ajax({

            type: "GET",

            dataType: "json",

            url: '{{ url('
            admin / exist_driver / change_status_exist ') }}',

            data: {
                'status_val': status_val,
                'd_id': d_id
            },

            success: function(data) {
                // console.log(data);
                location.reload();
            }

        });
    }
</script>
@stop