<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{ asset('https://vensemart.com/blocklive.com/images/favicon.ico') }}">
    <!-- Page Title  -->
    <title> vensemart.com</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('nk5/assets/css/dashlite.css?ver=2.9.1') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('nk5/assets/css/theme.css?ver=2.9.1') }}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    @livewireStyles
    <style>
.toast-top-center {
top: 12px;
margin: 0 auto;
left: 50%;
}



    </style>

</head>

<body class="nk-body npc-crypto bg-white has-sidebar ">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- sidebar @s -->
            <div class="nk-sidebar nk-sidebar-fixed " data-content="sidebarMenu">
                <div class="nk-sidebar-element nk-sidebar-head">
                    <div class="nk-sidebar-brand">
                        <a href="/index" class="logo-link nk-sidebar-logo">
                            <img class="logo-light logo-img" src="{{ asset('https://vensemart.com/assets/images/logo.png') }}" srcset="{{ asset('https://vensemart.com/assets/images/logo.png 2x') }}" alt="logo">
                            <img class="logo-dark logo-img" src="{{ asset('https://vensemart.com/assets/images/logo.png') }}" srcset="{{ asset('https://vensemart.com/assets/images/logo.png 2x') }}" alt="logo-dark">
                            Inc.
                        </a>
                    </div>
                    <div class="nk-menu-trigger mr-n2">
                        <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
                    </div>
                </div><!-- .nk-sidebar-element -->
                <div class="nk-sidebar-element">
                    <div class="nk-sidebar-body" data-simplebar>
                        <div class="nk-sidebar-content">
                            <div class="nk-sidebar-widget d-none d-xl-block">
                                <div class="user-account-info between-center">
                                    <div class="user-account-main">
                                        <h6 class="overline-title-alt">Available Balance</h6>
                                        <div class="user-balance">0 <small class="currency currency-btc">NGN</small></div>
                                       
                                    </div>
                                    <a href="#" class="btn btn-white btn-icon btn-light"><em class="icon ni ni-line-chart"></em></a>
                                </div>
                                <ul class="user-account-data gy-1">
                                    
                                    <li>
                                        <div class="user-account-label">
                                            <span class="sub-text">Total Orders</span>
                                        </div>
                                        <div class="user-account-value">
                                            <span class="sub-text"> <span class="currency currency-btc">NGN</span></span>
                                        </div>
                                    </li>
                                </ul>
                                <div class="user-account-actions">
                                    <ul class="g-3">
                                        <!--<li><a href="/deposit-create" class="btn btn-lg btn-primary"><span>Deposit</span></a></li>-->
                                        <!--<li><a href="/withdraw-create" class="btn btn-lg btn-warning"><span>Withdraw</span></a></li>-->
                                    </ul>
                                </div>
                            </div><!-- .nk-sidebar-widget -->
                            <div class="nk-sidebar-widget nk-sidebar-widget-full d-xl-none pt-0">
                                <a class="nk-profile-toggle toggle-expand" data-target="sidebarProfile" href="#">
                                    <div class="user-card-wrap">
                                        <div class="user-card">
                                            <div class="user-avatar">
                                                <span>AB</span>
                                            </div>
                                            <div class="user-info">
                                                <span class="lead-text">{{ auth()->user()->name }} </span>
                                                <span class="sub-text">{{ auth()->user()->email }}</span>
                                            </div>
                                            <div class="user-action">
                                                <em class="icon ni ni-chevron-down"></em>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <div class="nk-profile-content toggle-expand-content" data-content="sidebarProfile">
                                    <div class="user-account-info between-center">
                                        <div class="user-account-main">
                                            <h6 class="overline-title-alt">Available Balance</h6>
                                            <div class="user-balance"> <small class="currency currency-btc">NGN</small></div>
                                            <!--<div class="user-balance-alt">18,934.84 <span class="currency currency-btc">BTC</span></div>-->
                                        </div>
                                        <a href="#" class="btn btn-icon btn-light"><em class="icon ni ni-line-chart"></em></a>
                                    </div>
                                    <ul class="user-account-data">
                                       
                                        <li>
                                            <div class="user-account-label">
                                                <span class="sub-text">Deposit in orders</span>
                                            </div>
                                            <div class="user-account-value">
                                                <span class="sub-text text-base"> <span class="currency currency-btc">NGN</span></span>
                                            </div>
                                        </li>
                                    </ul>
                                    <ul class="user-account-links">
                                        <!--<li><a href="#" class="link"><span>Withdraw Funds</span> <em class="icon ni ni-wallet-out"></em></a></li>-->
                                        <!--<li><a href="/deposit-create" class="link"><span>Deposit Funds</span> <em class="icon ni ni-wallet-in"></em></a></li>-->
                                    </ul>
                                    <ul class="link-list">
                                        <li><a href="/profile"><em class="icon ni ni-user-alt"></em><span>View Profile</span></a></li>
                                        <li><a href="/profile-security"><em class="icon ni ni-setting-alt"></em><span>Account Setting</span></a></li>
                                        <li><a href="/profile-activity"><em class="icon ni ni-activity-alt"></em><span>Login Activity</span></a></li>
                                    </ul>
                                    <ul class="link-list">
                                        <li><a href="/logout"><em class="icon ni ni-signout"></em><span>Sign out</span></a></li>
                                    </ul>
                                </div>
                            </div><!-- .nk-sidebar-widget -->
                            <div class="nk-sidebar-menu">
                                <!-- Menu -->
                                <ul class="nk-menu">
                                    <li class="nk-menu-heading">
                                        <h6 class="overline-title">Menu</h6>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="/index" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-dashboard"></em></span>
                                            <span class="nk-menu-text">Dashboard</span>
                                        </a>
                                    </li>

                                   
                                    <!-- <li class="nk-menu-item">
                                        <a href="/wallets" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-wallet-alt"></em></span>
                                            <span class="nk-menu-text">Wallets</span>
                                        </a>
                                    </li> -->
                                    <!-- <li class="nk-menu-item">
                                        <a href="/buy-sell" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-coins"></em></span>
                                            <span class="nk-menu-text">Buy / Sell</span>
                                        </a>
                                    </li> -->
                                    <!-- <li class="nk-menu-item">
                                        <a href="/order-history" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-repeat"></em></span>
                                            <span class="nk-menu-text">Orders</span>
                                        </a>
                                    </li> -->


                                   


                    
                                    <!--<li class="nk-menu-item">-->
                                    <!--    <a href="/deposit-history" class="nk-menu-link">-->
                                    <!--        <span class="nk-menu-icon"><em class="icon ni ni-wallet-in"></em></span>-->
                                    <!--        <span class="nk-menu-text">Deposit History</span>-->
                                    <!--    </a>-->
                                    <!--</li>-->

                                    <!--<li class="nk-menu-item">-->
                                    <!--    <a href="/withdraw-history" class="nk-menu-link">-->
                                    <!--        <span class="nk-menu-icon"><em class="icon ni ni-wallet-out"></em></span>-->
                                    <!--        <span class="nk-menu-text">Withdraw History</span>-->
                                    <!--    </a>-->
                                    <!--</li>-->

                                   


                                    <li class="nk-menu-heading">
                                        <h6 class="overline-title">Product & Orders</h6>
                                    </li>

                                    
                                    
                                    <li class="nk-menu-item">
                                        <a href="/collectors" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-plus"></em></span>
                                            <span class="nk-menu-text">Create New Product</span>
                                        </a>
                                    </li>

                                    <li class="nk-menu-item">
                                        <a href="/duppp" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-card-view"></em></span>
                                            <span class="nk-menu-text">Product Catalogue</span>
                                        </a>
                                    </li>

                                    <li class="nk-menu-item">
                                        <a href="/edit-product" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-card-view"></em></span>
                                            <span class="nk-menu-text">Manage Product Stock</span>
                                        </a>
                                    </li>

                                    <li class="nk-menu-item">
                                        <a href="/orders-list" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-cc-alt2-fill"></em></span>
                                            <span class="nk-menu-text">Orders</span>
                                        </a>
                                    </li>


                                    <!-- <li class="nk-menu-heading">
                                        <h6 class="overline-title">Store Details</h6>
                                    </li> -->


                                    

                                    <li class="nk-menu-heading">
                                        <h6 class="overline-title">Vendor Details & Company</h6>
                                    </li>

                                    <li class="nk-menu-item">
                                        <a href="/dup" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni  ni-tranx"></em></span>
                                            <span class="nk-menu-text">Vendor Details</span>
                                        </a>
                                    </li>


                                    <li class="nk-menu-item">
                                        <a href="/dupp" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni  ni-tranx"></em></span>
                                            <span class="nk-menu-text">Company Details</span>
                                        </a>
                                    </li>


                                    <!-- <li class="nk-menu-heading">
                                        <h6 class="overline-title">Bank Details & Withdrawal</h6>
                                    </li> -->
<!-- 
                                    <li class="nk-menu-item">
                                        <a href="/dup" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni  ni-tranx"></em></span>
                                            <span class="nk-menu-text">Bank Details</span>
                                        </a>
                                    </li> -->


                                    <!-- <li class="nk-menu-item">
                                        <a href="/dupp" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni  ni-tranx"></em></span>
                                            <span class="nk-menu-text">Withdrawals</span>
                                        </a>
                                    </li> -->



                                    


                                    <!-- <li class="nk-menu-heading">
                                        <h6 class="overline-title">Orders</h6>
                                    </li> -->

<!-- 
                                    <li class="nk-menu-item">
                                        <a href="/portfolio" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni  ni-tranx"></em></span>
                                            <span class="nk-menu-text">General Details</span>
                                        </a>
                                    </li> -->

                                    


                                   

                                    <!-- <li class="nk-menu-item has-sub">
                                    <a href="/cr-coin" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class="icon ni ni-tranx"></em></span>
                                        <span class="nk-menu-text">CopyTrading History</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item">
                                            <a href="/portfolio" class="nk-menu-link"><span class="nk-menu-text">Stocks</span></a>
                                        </li>

                                        <li class="nk-menu-item">
                                            <a href="/portfolio-coins" class="nk-menu-link"><span class="nk-menu-text">Coins</span></a>
                                        </li>
                                        
                                         <li class="nk-menu-item">
                                            <a href="/portfolio-nfts" class="nk-menu-link"><span class="nk-menu-text">NFTs</span></a>
                                        </li>

                                        <li class="nk-menu-item">
                                            <a href="/portfolio-plans" class="nk-menu-link"><span class="nk-menu-text">Plans</span></a>
                                        </li> -->


                                        <!-- <li class="nk-menu-item">
                                            <a href="crypto1-project-list" class="nk-menu-link"><span class="nk-menu-text">Mining List</span></a>
                                        </li> -->
                                    <!-- </ul> -->
                                    <!-- .nk-menu-sub -->
                                <!-- </li> -->
                                <!-- .nk-menu-item -->

                                <!-- <li class="nk-menu-item">
                                        <a href="/profile" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-account-setting"></em></span>
                                            <span class="nk-menu-text">My Profile</span>
                                        </a>
                                </li> -->

                               

<!-- 
                                    <li class="nk-menu-heading">
                                        <h6 class="overline-title">CopyTrading</h6>
                                    </li>

                                    <li class="nk-menu-item">
                                        <a href="/investing" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-opt-alt"></em></span>
                                            <span class="nk-menu-text">Start</span>
                                        </a>
                                    </li> -->


                                    <!-- <li class="nk-menu-item">
                                        <a href="/coining" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-repeat"></em></span>
                                            <span class="nk-menu-text">Crypto</span>
                                        </a>
                                    </li> -->


                                    <!-- <li class="nk-menu-item">
                                        <a href="/nfting" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-img"></em></span>
                                            <span class="nk-menu-text">NFts</span>
                                        </a>
                                    </li>

                                    <li class="nk-menu-item">
                                        <a href="/planing" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-opt-dot"></em></span>
                                            <span class="nk-menu-text">Plans</span>
                                        </a>
                                    </li> -->


                                    <!-- <li class="nk-menu-item">
                                        <a href="/order-history" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-repeat"></em></span>
                                            <span class="nk-menu-text"></span>
                                        </a>
                                    </li> -->
                                    <!-- <li class="nk-menu-item">
                                        <a href="/chats" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-chat-circle"></em></span>
                                            <span class="nk-menu-text">Chats</span>
                                        </a>
                                    </li> -->
                                    
                                    <!-- <li class="nk-menu-item has-sub">
                                        <a href="#" class="nk-menu-link nk-menu-toggle">
                                            <span class="nk-menu-icon"><em class="icon ni ni-files"></em></span>
                                            <span class="nk-menu-text">Additional Pages</span>
                                        </a>
                                        <ul class="nk-menu-sub">
                                            <li class="nk-menu-item">
                                                <a href="/welcome" class="nk-menu-link"><span class="nk-menu-text">Welcome</span></a>
                                            </li>
                                            <li class="nk-menu-item">
                                                <a href="/kyc-application" class="nk-menu-link"><span class="nk-menu-text">KYC - Get Started</span></a>
                                            </li>
                                            <li class="nk-menu-item">
                                                <a href="/kyc-form" class="nk-menu-link"><span class="nk-menu-text">KYC - Application Form</span></a>
                                            </li> -->
                                        <!-- </ul> -->
                                        <!-- .nk-menu-sub -->
                                    <!-- </li> -->
                                    <!-- .nk-menu-item -->
                                    
                                    @if(auth()->user()->email == 'kuddlesteps@gmail.com')


                                    <li class="nk-menu-heading">
                                        <h6 class="overline-title">Admin</h6>
                                    </li>


                                    <li class="nk-menu-item has-sub">
                                    <a href="/cr-stock" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class="icon ni ni-user-list-fill"></em></span>
                                        <span class="nk-menu-text">Manage Users</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item">
                                            <a href="/users" class="nk-menu-link"><span class="nk-menu-text">User Information & Balance</span></a>
                                        </li>

                                        <!--<li class="nk-menu-item">-->
                                        <!--    <a href="/deposits" class="nk-menu-link"><span class="nk-menu-text">Manage Deposits</span></a>-->
                                        <!--</li>-->
                                        
                                        <!-- <li class="nk-menu-item">-->
                                        <!--    <a href="/withdrawals" class="nk-menu-link"><span class="nk-menu-text">Manage Withdrawals</span></a>-->
                                        <!--</li>-->
                                        <!-- <li class="nk-menu-item">
                                            <a href="crypto1-project-list" class="nk-menu-link"><span class="nk-menu-text">Mining List</span></a>
                                        </li> -->
                                    </ul><!-- .nk-menu-sub -->
                                </li><!-- .nk-menu-item -->


                                    <li class="nk-menu-item has-sub">
                                    <a href="/cr-stock" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class="icon ni ni-opt-alt-fill"></em></span>
                                        <span class="nk-menu-text">Manage Copytrades</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item">
                                            <a href="/cr-stock" class="nk-menu-link"><span class="nk-menu-text">Create  Trader</span></a>
                                        </li>

                                        <li class="nk-menu-item">
                                            <a href="/admin-stocks" class="nk-menu-link"><span class="nk-menu-text">Manage Traders</span></a>
                                        </li>
                                        
                                         <li class="nk-menu-item">
                                            <a href="/admin-stock-investments" class="nk-menu-link"><span class="nk-menu-text">User  Copytrades</span></a>
                                        </li>
                                        <!-- <li class="nk-menu-item">
                                            <a href="crypto1-project-list" class="nk-menu-link"><span class="nk-menu-text">Mining List</span></a>
                                        </li> -->
                                    </ul><!-- .nk-menu-sub -->
                                </li><!-- .nk-menu-item -->

                                    



                                <li class="nk-menu-item has-sub">
                                    <a href="/cr-coin" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class="icon ni ni-repeat-v"></em></span>
                                        <span class="nk-menu-text">Manage Profits</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item">
                                            <a href="/nw-profit" class="nk-menu-link"><span class="nk-menu-text">Create Profit Entry</span></a>
                                        </li>

                                        <li class="nk-menu-item">
                                            <a href="/profit" class="nk-menu-link"><span class="nk-menu-text">Manage Profit entry</span></a>
                                        </li>
                                        
                                         <!-- <li class="nk-menu-item">
                                            <a href="/admin-coin-investments" class="nk-menu-link"><span class="nk-menu-text">User Crypto Copytrades</span></a>
                                        </li> -->
                                        <!-- <li class="nk-menu-item">
                                            <a href="crypto1-project-list" class="nk-menu-link"><span class="nk-menu-text">Mining List</span></a>
                                        </li> -->
                                    </ul><!-- .nk-menu-sub -->
                                </li><!-- .nk-menu-item -->
                                
                                @endif
                                



                                <!-- <li class="nk-menu-item has-sub">
                                    <a href="/cr-nft" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class="icon ni ni-img-fill"></em></span>
                                        <span class="nk-menu-text">Manage Nft Copytrades</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item">
                                            <a href="/cr-nft" class="nk-menu-link"><span class="nk-menu-text">Create Nft Option</span></a>
                                        </li>

                                        <li class="nk-menu-item">
                                            <a href="/admin-nfts" class="nk-menu-link"><span class="nk-menu-text">Manage Nft Options</span></a>
                                        </li>
                                        
                                         <li class="nk-menu-item">
                                            <a href="/admin-nft-investments" class="nk-menu-link"><span class="nk-menu-text">User Nft Copytrades</span></a>
                                        </li> -->
                                        <!-- <li class="nk-menu-item">
                                            <a href="crypto1-project-list" class="nk-menu-link"><span class="nk-menu-text">Mining List</span></a>
                                        </li> -->
                                    <!-- </ul> -->
                                    <!-- .nk-menu-sub -->
                                <!-- </li> -->
                                <!-- .nk-menu-item -->
                                



                                <!-- <li class="nk-menu-item has-sub">
                                    <a href="/cr-coin" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class="icon ni ni-opt-dot-fill"></em></span>
                                        <span class="nk-menu-text">Manage Plan Copytrades</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item">
                                            <a href="/cr-plan" class="nk-menu-link"><span class="nk-menu-text">Create Plan Option</span></a>
                                        </li>

                                        <li class="nk-menu-item">
                                            <a href="/admin-plans" class="nk-menu-link"><span class="nk-menu-text">Manage Plan Options</span></a>
                                        </li>
                                        
                                         <li class="nk-menu-item">
                                            <a href="/admin-plan-investments" class="nk-menu-link"><span class="nk-menu-text">User Plan Copytrades</span></a>
                                        </li> -->
                                        <!-- <li class="nk-menu-item">
                                            <a href="crypto1-project-list" class="nk-menu-link"><span class="nk-menu-text">Mining List</span></a>
                                        </li> -->
                                    <!-- </ul> -->
                                    <!-- .nk-menu-sub -->
                                <!-- </li> -->
                                <!-- .nk-menu-item -->
                                




                                








                                    <!-- <li class="nk-menu-heading">
                                        <h6 class="overline-title">Return to</h6>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="/index" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-dashlite"></em></span>
                                            <span class="nk-menu-text">Main Dashboard</span>
                                        </a>
                                    </li> -->
                                    <!-- <li class="nk-menu-item">
                                        <a href="html/components.html" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-layers"></em></span>
                                            <span class="nk-menu-text">All Components</span>
                                        </a>
                                    </li> -->
                                </ul><!-- .nk-menu -->
                            </div><!-- .nk-sidebar-menu -->
                            <!-- <div class="nk-sidebar-widget">
                                <div class="widget-title">
                                    <h6 class="overline-title">Crypto Accounts <span></span></h6>
                                    <a href="#" class="link">View All</a>
                                </div>
                                <ul class="wallet-list">
                                    <li class="wallet-item">
                                        <a href="#">
                                            <div class="wallet-icon"><em class="icon ni ni-sign-kobo"></em></div>
                                            <div class="wallet-text">
                                                <h6 class="wallet-name">NioWallet</h6>
                                                <span class="wallet-balance">30.959040 <span class="currency currency-nio">NIO</span></span>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="wallet-item">
                                        <a href="#">
                                            <div class="wallet-icon"><em class="icon ni ni-sign-btc"></em></div>
                                            <div class="wallet-text">
                                                <h6 class="wallet-name">Bitcoin Wallet</h6>
                                                <span class="wallet-balance">0.0495950 <span class="currency currency-btc">BTC</span></span>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="wallet-item wallet-item-add">
                                        <a href="#">
                                            <div class="wallet-icon"><em class="icon ni ni-plus"></em></div>
                                            <div class="wallet-text">
                                                <h6 class="wallet-name">Add another wallet</h6>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div> -->
                            <!-- .nk-sidebar-widget -->
                            <div class="nk-sidebar-footer">
                                <ul class="nk-menu nk-menu-footer">
                                    <li class="nk-menu-item">
                                        <a href="#" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-help-alt"></em></span>
                                            <span class="nk-menu-text">Support</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item ml-auto">
                                        <div class="dropup">
                                            <a href="#" class="nk-menu-link dropdown-indicator has-indicator" data-toggle="dropdown" data-offset="0,10">
                                                <span class="nk-menu-icon"><em class="icon ni ni-globe"></em></span>
                                                <span class="nk-menu-text">English</span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                <ul class="language-list">
                                                    <li>
                                                        <a href="#" class="language-item">
                                                            <img src="{{ asset('nk5/images/flags/english.png') }}" alt="" class="language-flag">
                                                            <span class="language-name">English</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="language-item">
                                                            <img src="{{ asset('nk5/images/flags/spanish.png') }}" alt="" class="language-flag">
                                                            <span class="language-name">Español</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="language-item">
                                                            <img src="{{ asset('nk5/images/flags/french.png') }}" alt="" class="language-flag">
                                                            <span class="language-name">Français</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="language-item">
                                                            <img src="{{ asset('nk5/images/flags/turkey.png') }}" alt="" class="language-flag">
                                                            <span class="language-name">Türkçe</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul><!-- .nk-footer-menu -->
                            </div><!-- .nk-sidebar-footer -->
                        </div><!-- .nk-sidebar-content -->
                    </div><!-- .nk-sidebar-body -->
                </div><!-- .nk-sidebar-element -->
            </div>
            <!-- sidebar @e -->
            <!-- wrap @s -->
            <div class="nk-wrap ">
                <!-- main header @s -->
                <div class="nk-header nk-header-fluid nk-header-fixed is-light">
                    <div class="container-fluid">
                        <div class="nk-header-wrap">
                            <div class="nk-menu-trigger d-xl-none ml-n1">
                                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                            </div>
                            <div class="nk-header-brand d-xl-none">
                                <a href="/index" class="logo-link">
                                    <img class="logo-light logo-img" src="{{ asset('https://vensemart.com/assets/images/logo.png') }}" srcset="{{ asset('https://vensemart.com/assets/images/logo.png 2x') }}" alt="logo">
                                    <img class="logo-dark logo-img" src="{{ asset('https://vensemart.com/assets/images/logo.png') }}" srcset="{{ asset('https://vensemart.com/assets/images/logo.png 2x') }}" alt="logo-dark"></a>
                            </div>
                            <div class="nk-header-news d-none d-xl-block">
                                <div class="nk-news-list">
                                    <a class="nk-news-item" href="#">
                                        <div class="nk-news-icon">
                                            <em class="icon ni ni-card-view"></em>
                                        </div>
                                        <div class="nk-news-text">
                                            <p>Do you know the latest update of 2022? <span> A overview of our is now available on YouTube</span></p>
                                            <em class="icon ni ni-external"></em>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="nk-header-tools">
                                <ul class="nk-quick-nav">
                                    <li class="dropdown user-dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <div class="user-toggle">

                                            @if(auth()->user()->image == 'Abuja')

                                            <div class="user-avatar sm">
                                                    <em class="icon ni ni-user-alt"></em>
                                                </div>

                                                @else

                                                <div class="user-avatar sm">
                                                <img width="50" height="35" src="{{ asset('/storage/'.auth()->user()->image )  
                                            
                                            
                                        }}" /> 
                                            
                                                </div>


                                           
                                            @endif
                                                <div class="user-info d-none d-md-block">
                                                    <div class="user-status user-status-verified">active</div>
                                                    <div class="user-name dropdown-indicator">{{ auth()->user()->name }}</div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right dropdown-menu-s1">
                                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                                <div class="user-card">
                                                    <div class="user-avatar">
                                                        <span> <img width="50" height="35" src="{{ asset('/storage/'.auth()->user()->image ) }}" /></span>
                                                    </div>
                                                    <div class="user-info">
                                                        <span class="lead-text">{{ auth()->user()->name }} </span>
                                                        <span class="sub-text">{{ auth()->user()->email }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dropdown-inner user-account-info">
                                                <h6 class="overline-title-alt">Wallet Account</h6>
                                                <div class="user-balance"> <small class="currency currency-btc">NGN</small></div>
                                                <!--<div class="user-balance-sub">Locked <span>0.344939 <span class="currency currency-btc">BTC</span></span></div>-->
                                                <!--<a href=/deposit-create class="link"><span>Deposit Funds</span> <em class="icon ni ni-wallet-out"></em></a>-->
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <li><a href="/dup"><em class="icon ni ni-user-alt"></em><span>View Profile</span></a></li>
                                                    <li><a href="/profile-security"><em class="icon ni ni-setting-alt"></em><span>Account Setting</span></a></li>
                                                
                                                    <li><a class="dark-switch" href="#"><em class="icon ni ni-moon"></em><span>Dark Mode</span></a></li>
                                                </ul>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <li><a href="/logout"><em class="icon ni ni-signout"></em><span>Sign out</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- main header @e -->
                <!-- content @s -->
                @yield('content')
                <!-- content @e -->
                <!-- footer @s -->
                <div class="nk-footer nk-footer-fluid">
                    <div class="container-fluid">
                        <div class="nk-footer-wrap">
                            <div class="nk-footer-copyright"> &copy; 2017 vensemart.com. Blocklive <a href="vensemart.com">International Ltd</a>
                            </div>
                            <div class="nk-footer-links">
                                <ul class="nav nav-sm">
                                    <li class="nav-item"><a class="nav-link" href="#">Terms</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">Privacy</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">Help</a></li>
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
    <!-- JavaScript -->
    @livewireScripts


    
    <script>
  @if(Session::has('message'))
  
  toastr.options =
  {
    "closeButton" : true,
    "positionClass": "toast-bottom-right",
    "progressBar" : true
  }
  
      toastr.success("{{ session('message') }}");
  @endif

  @if(Session::has('error'))
  toastr.options =
  {
    "closeButton" : true,
    "progressBar" : true
  }
      toastr.error("{{ session('error') }}");
  @endif

  @if(Session::has('info'))
  toastr.options =
  {
    "closeButton" : true,
    "progressBar" : true
  }
      toastr.info("{{ session('info') }}");
  @endif

  @if(Session::has('warning'))
  toastr.options =
  {
    "closeButton" : true,
    "progressBar" : true
  }
      toastr.warning("{{ session('warning') }}");
  @endif
</script>

    <!-- <script src="//code.tidio.co/l8uhyte13onqzs7vhh3t11jwzxtkqri3.js" async></script> -->
    <script src="{{ asset('nk5/assets/js/bundle.js?ver=2.9.1') }}"></script>
    <script src="{{ asset('nk5/assets/js/scripts.js?ver=2.9.1') }}"></script>
    <script src="{{ asset('nk5/assets/js/charts/chart-crypto.js?ver=2.9.1') }}"></script>
</body>
@livewireScripts
</html>