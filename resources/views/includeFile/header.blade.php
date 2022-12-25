 <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="javascript:void(0);" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        
      </li>
    </ul>
 
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        
        <div class="navbar-search-block">
          
        </div>
      </li>
      <!-- setting panel  -->
       
      <!-- setting panel end  -->
      <!-- Messages Dropdown Menu -->
      
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
         
        <a class="nav-link" data-toggle="dropdown" href="javascript:void(0);">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">0</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header"> Notifications</span>
         
          <div class="dropdown-divider"></div>
          <a href="" class="dropdown-item">
           
            <!--<span class="float-right text-muted text-sm">3 mins</span>-->
          </a>
          
         
          <a href="javascript:void(0);" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <!-- Logout panel -->
        <li class="nav-item dropdown">
        <a class="nav-link"  data-toggle="dropdown" href="javascript:void(0);">
               <?php if(Auth::check()){ 
                $image =  Auth::user()->profile_image;
               ?>
         <img src="{{ url('uploads/profile').'/'.$image }}" class="img-circle elevation-2" alt="User Image" style="width: 35px; height: 35px; ">
          <?php }else{ ?>
          <i class="fas fa-user-circle"></i>
         <?php } ?>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          
          <div class="dropdown-divider"></div>
          <a href="{{ URL::to('admin/profile') }}" class="dropdown-item">
            <i class="fas fa-user"></i> Profile
          </a>
         
          <div class="dropdown-divider"></div>
          <a href="{{ URL::to('admin/logout') }}" class="dropdown-item">
            <i class="fas fa-sign-out-alt"></i> Logout
          </a>
          <div class="dropdown-divider"></div>
        </div>
      </li>
      <!-- Logout panel end    -->
      <!--<li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="javascript:void(0);" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>-->
    </ul>
  </nav>