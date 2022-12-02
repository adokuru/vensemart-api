@extends('Admin/app')

@section('content')
 <div class="content-wrapper">
   

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
           
            <!-- /.card -->

    <div class="card" style="overflow: hidden;">
             <div class="card-header d-flex align-items-center">   
                <h3 class="card-title">FAQ List</h3>
                 <?php // if(Session::get('isAdmin') || checkAccess(1) == 2 ){?>
                <div class=" ml-auto w-75 text-right ">
                    <a href="{{url('admin/faq/add')}}" class="btn btn-primary btn-sm px-3"> Add</a>
                    </div>
                <?php // } ?>
              </div>
    <div class="card-body">
              <div class="row">
                <div class="col-12" id="accordion">
                    <?php if($listing){ $i=1; foreach($listing as $value){?>
                  <div class="card card-primary card-outline">
                    <a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapse{{$i}}" aria-expanded="false">
                      <div class="card-header">
                        <h4 class="card-title w-100 d-flex justify-content-between align-items-center">
                          {{$i}}. {{$value->question}} ?
                          <a href="{{url('admin/faq/edit').'/'. $value->id}}" class="btn-sm px-3"><i class="far fa-edit "></i> </a>
                          | <a href="{{url('admin/faq/delete').'/'.  $value->id}}" onclick="return confirm('Are you sure you want to delete this record?');"  class="btn-sm px-3"><i class="fas fa-trash-alt red"></i></a>
                        </h4>
                      </div>
                    </a>
                    <div id="collapse{{$i}}" class="collapse" data-parent="#accordion" style="">
                      <div class="card-body">
                        {{$value->answer}}.
                      </div>
                    </div>
                  </div>
                <?php $i++; }}?>

                </div>
              </div>
            </div
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