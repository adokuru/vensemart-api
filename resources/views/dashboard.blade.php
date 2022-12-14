
@extends('app')

@section('content')
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
         <div class="card-body">
                <section class="content">
                  <div class="container-fluid">
                    <div class="row">
                      <div class="col-md-6">
                        <a href="javascript:void(0);">
                          <div class="panel panel-success pricing-big">
                            <div class="panel-heading">
                              <h3 class="panel-title">New user
                              <span class="panel-title" style="display:inline-block;float:right;font-size:18px;">{{$get_total_yearly_new_user}}</span></h3>
                            </div>
                            <div class="">
                              <div class="row">
                                <div class="col-md-3 col-6 text-center reports">
                                  <h5>Daily
                                    <strong>{{$get_total_daily_new_user}}</strong>
                                  </h5>
                                </div>
                                <div class="col-md-3 col-6 text-center reports">
                                  <h5>Weekly
                                    <strong>{{$get_total_weekly_new_user}}</strong>
                                  </h5>
                                </div>
                                <div class="col-md-3 col-6 text-center reports">
                                  <h5>Monthly
                                    <strong>{{$get_total_monthly_new_user}}</strong>
                                  </h5>
                                </div>
                                <div class="col-md-3 col-6 text-center reports">
                                  <h5>Yearly
                                    <strong>{{$get_total_yearly_new_user}}</strong>
                                  </h5>
                                </div>
                              </div>
                            </div>
                          </div>
                        </a>
                      </div>
                      <div class="col-md-6">
                        <a href="javascript:void(0);">
                          <div class="panel panel-success pricing-big">
                            <div class="panel-heading">
                              <h3 class="panel-title">Existing User
                              <span class="panel-title" style="display:inline-block;float:right;font-size:18px;">{{$get_total_yearly_existing_user}}</span></h3>
                            </div>
                            <div class="">
                              <div class="row">
                                <div class="col-md-3 col-6 text-center reports">
                                  <h5>Daily
                                    <strong>{{$get_total_daily_existing_user}}</strong>
                                  </h5>
                                </div>
                                <div class="col-md-3 col-6 text-center reports">
                                  <h5>Weekly
                                    <strong>{{$get_total_weekly_existing_user}}</strong>
                                  </h5>
                                </div>
                                <div class="col-md-3 col-6 text-center reports">
                                  <h5>Monthly
                                    <strong>{{$get_total_monthly_existing_user}}</strong>
                                  </h5>
                                </div>
                                <div class="col-md-3 col-6 text-center reports">
                                  <h5>Yearly
                                    <strong>{{$get_total_yearly_existing_user}}</strong>
                                  </h5>
                                </div>
                              </div>
                            </div>
                          </div>
                        </a>
                      </div>
                 
                    </div>
                  </div>
                  
                  <div class="container-fluid mt-3">
                    <div class="row">
                      <div class="col-md-6">
                        <a href="javascript:void(0);">
                          <div class="panel panel-info pricing-big">
                            <div class="panel-heading">
                              <h3 class="panel-title">Delivery Person  Registration
                              <span class="panel-title" style="display:inline-block;float:right;font-size:18px;">{{$get_total_yearly_new_driver}}</span></h3>
                            </div>
                            <div class="">
                              <div class="row">
                                <div class="col-md-3 col-6 text-center reports">
                                  <h5>Daily
                                    <strong>{{$get_total_daily_new_driver}}</strong>
                                  </h5>
                                </div>
                                <div class="col-md-3 col-6 text-center reports">
                                  <h5>Weekly
                                    <strong>{{$get_total_weekly_new_driver}}</strong>
                                  </h5>
                                </div>
                                <div class="col-md-3 col-6 text-center reports">
                                  <h5>Monthly
                                    <strong>{{$get_total_monthly_new_driver}}</strong>
                                  </h5>
                                </div>
                                <div class="col-md-3 col-6 text-center reports">
                                  <h5>Yearly
                                    <strong>{{$get_total_yearly_new_driver}}</strong>
                                  </h5>
                                </div>
                              </div>
                            </div>
                          </div>
                        </a>
                      </div>
                      <div class="col-md-6">
                        <a href="javascript:void(0);">
                          <div class="panel panel-info pricing-big">
                            <div class="panel-heading">
                              <h3 class="panel-title">Existing Delivery Person
                              <span class="panel-title" style="display:inline-block;float:right;font-size:18px;">{{$get_total_yearly_existing_driver}}</span></h3>
                            </div>
                            <div class="">
                              <div class="row">
                                <div class="col-md-3 col-6 text-center reports">
                                  <h5>Daily
                                    <strong>{{$get_total_daily_existing_driver}}</strong>
                                  </h5>
                                </div>
                                <div class="col-md-3 col-6 text-center reports">
                                  <h5>Weekly
                                    <strong>{{$get_total_weekly_existing_driver}}</strong>
                                  </h5>
                                </div>
                                <div class="col-md-3 col-6 text-center reports">
                                  <h5>Monthly
                                    <strong>{{$get_total_monthly_existing_driver}}</strong>
                                  </h5>
                                </div>
                                <div class="col-md-3 col-6 text-center reports">
                                  <h5>Yearly
                                    <strong>{{$get_total_yearly_existing_driver}}</strong>
                                  </h5>
                                </div>
                              </div>
                            </div>
                          </div>
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="container-fluid mt-3">
                    <div class="row">
                      <div class="col-md-6">
                        <a href="javascript:void(0);">
                          <div class="panel panel-warning pricing-big">
                            <div class="panel-heading">
                              <h3 class="panel-title"> Total Ordered Placed
                              <span class="panel-title" style="display:inline-block;float:right;font-size:18px;">{{$ordered_placed_total}}</span></h3>
                            </div>
                            <div class="">
                              <div class="row">
                                <div class="col-md-3 col-6 text-center reports">
                                  <h5>Daily
                                    <strong>{{$ordered_placed_daily}}</strong>
                                  </h5>
                                </div>
                                <div class="col-md-3 col-6 text-center reports">
                                  <h5>Weekly
                                    <strong>{{$ordered_placed_weekly}}</strong>
                                  </h5>
                                </div>
                                <div class="col-md-3 col-6 text-center reports">
                                  <h5>Monthly
                                    <strong>{{$ordered_placed_monthly}}</strong>
                                  </h5>
                                </div>
                                <div class="col-md-3 col-6 text-center reports">
                                  <h5>Yearly
                                    <strong>{{$ordered_placed_yearly}}</strong>
                                  </h5>
                                </div>
                              </div>
                            </div>
                          </div>
                        </a>
                      </div>
                      <div class="col-md-6">
                        <a href="javascript:void(0);">
                          <div class="panel panel-warning pricing-big">
                            <div class="panel-heading">
                              <h3 class="panel-title">Total New Product Added 
                              <span class="panel-title" style="display:inline-block;float:right;font-size:18px;">{{ $total_new_product }}</span></h3>
                            </div>
                            <div class="">
                              <div class="row">
                                <div class="col-md-3 col-6 text-center reports">
                                  <h5>Daily
                                    <strong>{{$total_daily_new_product}}</strong>
                                  </h5>
                                </div>
                                <div class="col-md-3 col-6 text-center reports">
                                  <h5>Weekly
                                    <strong>{{$total_weekly_new_product}}</strong>
                                  </h5>
                                </div>
                                <div class="col-md-3 col-6 text-center reports">
                                  <h5>Monthly
                                    <strong>{{$total_monthly_new_product}}</strong>
                                  </h5>
                                </div>
                                <div class="col-md-3 col-6 text-center reports">
                                  <h5>Yearly
                                    <strong>{{$total_yearly_new_product}}</strong>
                                  </h5>
                                </div>
                              </div>
                            </div>
                          </div>
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="container-fluid mt-3">
                    <div class="row">
                      <div class="col-md-6">
                        <a href="javascript:void(0);">
                          <div class="panel panel-danger pricing-big">
                            <div class="panel-heading">
                              <h3 class="panel-title">Total Out Of Stock Product
                              <span class="panel-title" style="display:inline-block;float:right;font-size:18px;">{{$total_out_of_stack_product}}</span></h3>
                            </div>
                            <div class="">
                              <div class="row">
                                <div class="col-md-3 col-6 text-center reports">
                                  <h5>Daily
                                    <strong>{{$total_daily_out_of_stack_product}}</strong>
                                  </h5>
                                </div>
                                <div class="col-md-3 col-6 text-center reports">
                                  <h5>Weekly
                                    <strong>{{$total_weekly_out_of_stack_product}}</strong>
                                  </h5>
                                </div>
                                <div class="col-md-3 col-6 text-center reports">
                                  <h5>Monthly
                                    <strong>{{$total_monthly_out_of_stack_product}}</strong>
                                  </h5>
                                </div>
                                <div class="col-md-3 col-6 text-center reports">
                                  <h5>Yearly
                                    <strong>{{$total_yearly_out_of_stack_product}}</strong>
                                  </h5>
                                </div>
                              </div>
                            </div>
                          </div>
                        </a>
                      </div>
                     
                    </div>
                  </div>
             
                  <!--<div class="container-fluid mt-3">-->
                  <!--  <div class="row">-->
                  <!--    <div class="col-md-6">-->
                  <!--      <a href="">-->
                  <!--        <div class="panel panel-warning pricing-big">-->
                  <!--          <div class="panel-heading">-->
                  <!--            <h3 class="panel-title">Service Provider Recharge Due-->
                  <!--            <span class="panel-title" style="display:inline-block;float:right;font-size:18px;">0</span></h3>-->
                  <!--          </div>-->
                  <!--          <div class="">-->
                  <!--            <div class="row">-->
                  <!--              <div class="col-md-3 col-6 text-center reports">-->
                  <!--                <h5>Today-->
                  <!--                  <strong>0</strong>-->
                  <!--                </h5>-->
                  <!--              </div>-->
                  <!--              <div class="col-md-3 col-6 text-center reports">-->
                  <!--                <h5>Two Days-->
                  <!--                  <strong>0</strong>-->
                  <!--                </h5>-->
                  <!--              </div>-->
                  <!--              <div class="col-md-3 col-6 text-center reports">-->
                  <!--                <h5 style="padding: 22px 15px">Three Days-->
                  <!--                  <strong>0</strong>-->
                  <!--                </h5>-->
                  <!--              </div>-->
                  <!--              <div class="col-md-3 col-6 text-center reports">-->
                  <!--                <h5 style="padding: 22px 15px">Four Days-->
                  <!--                  <strong>0</strong>-->
                  <!--                </h5>-->
                  <!--              </div>-->
                  <!--            </div>-->
                  <!--          </div>-->
                  <!--        </div>-->
                  <!--      </a>-->
                  <!--    </div>-->
                      
                  <!--  </div>-->
                  <!--</div>-->
                </section>
              </div>   
     
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
@stop