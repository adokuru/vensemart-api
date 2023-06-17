@extends('nk1/layouts/nk5layout')

@section('content')
         <!-- content @s -->
                <div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-between">
                                        <div class="nk-block-head-content">
                                            <h3 class="nk-block-title page-title"> Vensemart Vendor</h3>
                                            <div class="nk-block-des text-soft">
                                                <p>Welcome to Vendor Dashboard</p>
                                            </div>
                                        </div><!-- .nk-block-head-content -->
                                        <div class="nk-block-head-content">
                                            <div class="toggle-wrap nk-block-tools-toggle">
                                                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                                <div class="toggle-expand-content" data-content="pageMenu">
                                                    <ul class="nk-block-tools g-3">
                                                        <li><a href="/collectors" class="btn btn-white btn-dim btn-outline-primary"><em class="icon ni ni-plus"></em><span>Create New Product</span></a></li>
                                                        <li><a href="/dupp" class="btn btn-white btn-dim btn-outline-primary"><em class="icon ni ni-bag-fill"></em><span>Manage Store</span></a></li>
                                                        
                                                    </ul>
                                                </div><!-- .toggle-expand-content -->
                                            </div><!-- .toggle-wrap -->
                                        </div><!-- .nk-block-head-content -->
                                    </div><!-- .nk-block-between -->
                                </div><!-- .nk-block-head -->


                                <div class="nk-block">
                                    <div class="row g-gs">
                                        <div class="col-md-4">
                                            <div class="card card-bordered card-full">
                                                <div class="card-inner">
                                                    <div class="card-title-group align-start mb-0">
                                                        <div class="card-title">
                                                            <h6 class="subtitle">Total Sales</h6>
                                                        </div>
                                                        <div class="card-tools">
                                                            <em class="card-hint icon ni ni-help-fill" data-toggle="tooltip" data-placement="left" title="Total Deposited"></em>
                                                        </div>
                                                    </div>
                                                    <div class="card-amount">
                                                        <span class="amount"> {{ $salesCount }} <span class="currency currency-usd"></span>
                                                        </span>
                                                        <!-- <span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>1.93%</span> -->
                                                    </div>
                                                    <div class="invest-data">
                                                        <div class="invest-data-amount g-2">
                                                            <div class="invest-data-history">
                                                                <div class="title">This Month</div>
                                                                <div class="amount">{{ $salesCount }} <span class="currency currency-usd">  </span></div>
                                                            </div>
                                                            <div class="invest-data-history">
                                                                <div class="title">This Week</div>
                                                                <div class="amount">{{ $salesCount }} <span class="currency currency-usd"> </span></div>
                                                            </div>

                                                            <div class="invest-data-history">
                                                                <div class="title">Today</div>
                                                                <div class="amount">{{ $salesCount }} <span class="currency currency-usd"> </span></div>
                                                            </div>
                                                        </div>
                                                        <div class="invest-data-ck">
                                                            <canvas class="iv-data-chart" id="totalDeposit"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- .card -->
                                        </div><!-- .col -->


                                        <div class="col-md-4">
                                            <div class="card card-bordered card-full">
                                                <div class="card-inner">
                                                    <div class="card-title-group align-start mb-0">
                                                        <div class="card-title">
                                                            <h6 class="subtitle">Total Number of Orders</h6>
                                                        </div>
                                                        <div class="card-tools">
                                                            <em class="card-hint icon ni ni-help-fill" data-toggle="tooltip" data-placement="left" title="Total Withdraw"></em>
                                                        </div>
                                                    </div>
                                                    <div class="card-amount">
                                                        <span class="amount"> {{ $ordersCount }}<span class="currency currency-usd"></span>
                                                        </span>
                                                        <!-- <span class="change down text-danger"><em class="icon ni ni-arrow-long-down"></em>1.93%</span> -->
                                                    </div>
                                                    <div class="invest-data">
                                                        <div class="invest-data-amount g-2">
                                                            <div class="invest-data-history">
                                                                <div class="title">This Month</div>
                                                                <div class="amount">{{ $ordersCount }} <span class="currency currency-usd"> </span></div>
                                                            </div>

                                                            <div class="invest-data-history">
                                                                <div class="title">This Week</div>
                                                                <div class="amount">{{ $ordersCount }} <span class="currency currency-usd">  </span></div>
                                                            </div>


                                                            <div class="invest-data-history">
                                                                <div class="title">Today</div>
                                                                <div class="amount">{{ $ordersCount }} <span class="currency currency-usd"> </span></div>
                                                            </div>
                                                            
                                                        </div>
                                                        <div class="invest-data-ck">
                                                            <canvas class="iv-data-chart" id="totalWithdraw"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- .card -->
                                        </div><!-- .col -->



                                        <div class="col-md-4">
                                            <div class="card card-bordered  card-full">
                                                <div class="card-inner">
                                                    <div class="card-title-group align-start mb-0">
                                                        <div class="card-title">
                                                            <h6 class="subtitle">Total Products</h6>
                                                        </div>
                                                        <div class="card-tools">
                                                            <em class="card-hint icon ni ni-help-fill" data-toggle="tooltip" data-placement="left" title="Total Balance in Account"></em>
                                                        </div>
                                                    </div>
                                                    <div class="card-amount">
                                                        <span class="amount"> {{ $productsCount }} <span class="currency currency-usd"></span>
                                                        </span>
                                                    </div>
                                                    <div class="invest-data">
                                                        <div class="invest-data-amount g-2">
                                                            <div class="invest-data-history">
                                                                <div class="title">This Month</div>
                                                                <div class="amount">{{ $productsCount }} <span class="currency currency-usd"> </span></div>
                                                            </div>
                                                            <div class="invest-data-history">
                                                                <div class="title">This Week</div>
                                                                <div class="amount">{{ $productsCount }} <span class="currency currency-usd"> </span></div>
                                                            </div>

                                                            <div class="invest-data-history">
                                                                <div class="title">Today</div>
                                                                <div class="amount">{{ $productsCount }} <span class="currency currency-usd"> </span></div>
                                                            </div>

                                                        </div>
                                                        <div class="invest-data-ck">
                                                            <canvas class="iv-data-chart" id="totalBalance"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- .card -->
                                        </div><!-- .col -->
                            </div>



                            <div class="nk-block">
                                    <div class="row g-gs">
                                        <div class="col-md-4">
                                            <div class="card card-bordered card-full">
                                                <div class="card-inner">
                                                    <div class="card-title-group align-start mb-0">
                                                        <div class="card-title">
                                                            <h6 class="subtitle">Total Completed Orders</h6>
                                                        </div>
                                                        <div class="card-tools">
                                                            <em class="card-hint icon ni ni-help-fill" data-toggle="tooltip" data-placement="left" title="Total Deposited"></em>
                                                        </div>
                                                    </div>
                                                    <div class="card-amount">
                                                        <span class="amount"> {{ $salesCount }} <span class="currency currency-usd"></span>
                                                        </span>
                                                        <!-- <span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>1.93%</span> -->
                                                    </div>
                                                    <div class="invest-data">
                                                        <div class="invest-data-amount g-2">
                                                            <div class="invest-data-history">
                                                                <div class="title">This Month</div>
                                                                <div class="amount">{{ $salesCount }} Orders <span class="currency currency-usd"> </span></div>
                                                            </div>
                                                            <div class="invest-data-history">
                                                                <div class="title">This Week</div>
                                                                <div class="amount">{{ $salesCount }} Orders<span class="currency currency-usd"> </span></div>
                                                            </div>

                                                            <div class="invest-data-history">
                                                                <div class="title">Today</div>
                                                                <div class="amount">{{ $salesCount }} Orders<span class="currency currency-usd"> </span></div>
                                                            </div>
                                                        </div>
                                                        <div class="invest-data-ck">
                                                            <canvas class="iv-data-chart" id="totalDeposit"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- .card -->
                                        </div><!-- .col -->


                                        <div class="col-md-4">
                                            <div class="card card-bordered card-full">
                                                <div class="card-inner">
                                                    <div class="card-title-group align-start mb-0">
                                                        <div class="card-title">
                                                            <h6 class="subtitle">Total Pending Orders</h6>
                                                        </div>
                                                        <div class="card-tools">
                                                            <em class="card-hint icon ni ni-help-fill" data-toggle="tooltip" data-placement="left" title="Total Withdraw"></em>
                                                        </div>
                                                    </div>
                                                    <div class="card-amount">
                                                        <span class="amount"> {{ $pendingCount }} <span class="currency currency-usd"></span>
                                                        </span>
                                                        <!-- <span class="change down text-danger"><em class="icon ni ni-arrow-long-down"></em>1.93%</span> -->
                                                    </div>
                                                    <!-- <div class="invest-data">
                                                        <div class="invest-data-amount g-2">
                                                            <div class="invest-data-history">
                                                                <div class="title">This Month</div>
                                                                <div class="amount">0.00 <span class="currency currency-usd">NGN</span></div>
                                                            </div>

                                                            <div class="invest-data-history">
                                                                <div class="title">This Week</div>
                                                                <div class="amount">0.00 <span class="currency currency-usd">NGN</span></div>
                                                            </div>


                                                            <div class="invest-data-history">
                                                                <div class="title">Today</div>
                                                                <div class="amount">0.00 <span class="currency currency-usd">NGN</span></div>
                                                            </div>
                                                            
                                                        </div>
                                                        <div class="invest-data-ck">
                                                            <canvas class="iv-data-chart" id="totalWithdraw"></canvas>
                                                        </div>
                                                    </div> -->
                                                </div>
                                            </div><!-- .card -->
                                        </div><!-- .col -->



                                        <div class="col-md-4">
                                            <div class="card card-bordered  card-full">
                                                <div class="card-inner">
                                                    <div class="card-title-group align-start mb-0">
                                                        <div class="card-title">
                                                            <h6 class="subtitle">Total Products Delivered</h6>
                                                        </div>
                                                        <div class="card-tools">
                                                            <em class="card-hint icon ni ni-help-fill" data-toggle="tooltip" data-placement="left" title="Total Balance in Account"></em>
                                                        </div>
                                                    </div>
                                                    <div class="card-amount">
                                                        <span class="amount"> {{ $salesCount }} <span class="currency currency-usd"></span>
                                                        </span>
                                                    </div>
                                                    <!-- <div class="invest-data">
                                                        <div class="invest-data-amount g-2">
                                                            <div class="invest-data-history">
                                                                <div class="title">This Month</div>
                                                                <div class="amount">0.00 <span class="currency currency-usd"></span></div>
                                                            </div>
                                                            <div class="invest-data-history">
                                                                <div class="title">This Week</div>
                                                                <div class="amount">0.00 <span class="currency currency-usd"></span></div>
                                                            </div>

                                                            <div class="invest-data-history">
                                                                <div class="title">Today</div>
                                                                <div class="amount">0.00 <span class="currency currency-usd"></span></div>
                                                            </div>

                                                        </div>
                                                        <div class="invest-data-ck">
                                                            <canvas class="iv-data-chart" id="totalBalance"></canvas>
                                                        </div>
                                                    </div> -->
                                                </div>
                                            </div><!-- .card -->
                                        </div><!-- .col -->



                           
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content @e -->
                <!-- footer @s -->
                <div class="nk-footer">
                    <div class="container-fluid">
                        <div class="nk-footer-wrap">
                            <div class="nk-footer-copyright"> &copy; 2022 <a href="https://vensemart.com" target="_blank">Vensemart Apps Limited</a>
                            </div>
                            <div class="nk-footer-links">
                                <ul class="nav nav-sm">
                                    <li class="nav-item dropup">
                                        <a herf="#" class="dropdown-toggle dropdown-indicator has-indicator nav-link" data-toggle="dropdown" data-offset="0,10"><span>English</span></a>
                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                            <ul class="language-list">
                                                <li>
                                                    <a href="#" class="language-item">
                                                        <span class="language-name">English</span>
                                                    </a>
                                                </li>


                                                <!-- <li>
                                                    <a href="#" class="language-item">
                                                        <span class="language-name">Español</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" class="language-item">
                                                        <span class="language-name">Français</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" class="language-item">
                                                        <span class="language-name">Türkçe</span>
                                                    </a>
                                                </li> -->
                                            </ul>
                                        </div>
                                    </li>
                                    <!-- <li class="nav-item">
                                        <a href="#" data-toggle="modal" data-target="#region" class="nav-link"><em class="icon ni ni-globe"></em><span class="ml-1">Select Region</span></a>
                                    </li> -->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- footer @e -->
            </div>
            <!-- wrap @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- select region modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="region">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <h5 class="title mb-4">Select Your Country</h5>
                    <div class="nk-country-region">
                        <ul class="country-list text-center gy-2">
                            <li>
                                <a href="#" class="country-item">
                                    <img src="./images/flags/arg.png" alt="" class="country-flag">
                                    <span class="country-name">Argentina</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="./images/flags/aus.png" alt="" class="country-flag">
                                    <span class="country-name">Australia</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="./images/flags/bangladesh.png" alt="" class="country-flag">
                                    <span class="country-name">Bangladesh</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="./images/flags/canada.png" alt="" class="country-flag">
                                    <span class="country-name">Canada <small>(English)</small></span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="./images/flags/china.png" alt="" class="country-flag">
                                    <span class="country-name">Centrafricaine</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="./images/flags/china.png" alt="" class="country-flag">
                                    <span class="country-name">China</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="./images/flags/french.png" alt="" class="country-flag">
                                    <span class="country-name">France</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="./images/flags/germany.png" alt="" class="country-flag">
                                    <span class="country-name">Germany</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="./images/flags/iran.png" alt="" class="country-flag">
                                    <span class="country-name">Iran</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="./images/flags/italy.png" alt="" class="country-flag">
                                    <span class="country-name">Italy</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="./images/flags/mexico.png" alt="" class="country-flag">
                                    <span class="country-name">México</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="./images/flags/philipine.png" alt="" class="country-flag">
                                    <span class="country-name">Philippines</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="./images/flags/portugal.png" alt="" class="country-flag">
                                    <span class="country-name">Portugal</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="./images/flags/s-africa.png" alt="" class="country-flag">
                                    <span class="country-name">South Africa</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="./images/flags/spanish.png" alt="" class="country-flag">
                                    <span class="country-name">Spain</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="./images/flags/switzerland.png" alt="" class="country-flag">
                                    <span class="country-name">Switzerland</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="./images/flags/uk.png" alt="" class="country-flag">
                                    <span class="country-name">United Kingdom</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="./images/flags/english.png" alt="" class="country-flag">
                                    <span class="country-name">United State</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div><!-- .modal-content -->
        </div><!-- .modla-dialog -->
    </div><!-- .modal -->
    <!-- JavaScript -->

    <!-- <script src="{{ asset('nk2/assets/js/bundle.js?ver=2.9.1') }}"></script>
    <script src="{{ asset('nk2/assets/js/scripts.js?ver=2.9.1') }}"></script>
    <script src="{{ asset('nk2/assets/js/charts/gd-default.js?ver=2.9.1') }}"></script> -->
@endsection