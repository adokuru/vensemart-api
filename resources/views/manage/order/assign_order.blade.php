@extends('Admin/app')

@section('content')
 <div class="content-wrapper">
   

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
           
            <!-- /.card -->

      <div class="card ">
            <div class="card-header bg-dark mt-0">
                <h3 class="card-title">Assign Order</h3>
            </div>
              <!-- /.card-header -->
            <div class="card-body">
             <div class="row">
      <div class="col-md-12" style="padding: 15px 0px; width:95%; margin:0px 10px;background: #fff; padding:0px 0px 20px 0px;">
          <div class="portlet box blue">
             
              <div class="portlet-body">
                  <div class="form-body">
                      <form  action="{{ url('admin/orderAssign') }} " method="post" id="menu_add" >
                          @csrf
                          <div class="row">
                              <div class="form-group col-md-6">
                                  <label for="order">Order Number:</label>
                                  <div>
                                      <input type="hidden" name="order_id" value="{{ $order_id }}">{{ $order_id }}
                                  </div>
                              </div>
                              <div class="form-group col-md-6">
                                  <label>Delivery Person <span class="required" aria-required="true"> * </span></label>
                                  <div class="select-style1">
                                      <select  class="form-control" name="driver_id" placeholder="" id="delivery_type_id">
                                        <?php if(count($driver_list) > 0) { foreach($driver_list as $dl){ ?>  
                                          <option value="{{ $dl->id }}">{{ $dl->name}}</option>
                                        <?php }} ?> 
                                    </select>
                                  </div>
                                  <span class="help-block"></span>
                              </div>

                          </div>
                          <div classs="row">
                               <div class="form-group col-md-6">
                                  <label>delivery pickup Date <span class="required" aria-required="true"> * </span></label>
                                  <div class="select-style1">
                                      <input type="date"  id="date_picker" name="delivery_date" class="fomm-control">
                                  </div>
                                  <span class="help-block"></span>
                              </div>
                          </div>

                          <div class="text-center margin_top_btm_20 col-md-12" style="margin-top: 10px;">
                              <button type="submit" class="btn btn-success">Assign</button>
                              <a class="btn btn-default" href="{{ url('admin/orders') }}">Cancel</a>
                          </div>
                      </form>

                  </div>

              </div>
          </div>

      </div>

  </div>
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
 <script language="javascript">
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear();

        today = yyyy + '-' + mm + '-' + dd;
        $('#date_picker').attr('min',today);
    </script>
@stop