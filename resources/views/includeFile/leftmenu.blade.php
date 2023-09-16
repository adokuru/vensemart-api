<div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <!-- SidebarSearch Form -->
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         
          <li class="nav-item">
            <a href="#" class="nav-link">
          
              <p>
                Manage User
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="{{ url('admin/managenew_user')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>New user</p>
                </a>
              </li>

               <li class="nav-item">
                <a href="{{ url('admin/manageexisting_user')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Existing User</p>
                </a>
              </li>


              <li class="nav-item">
                <a href="{{ url('admin/manageexisting_user_refer')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Referrals and Users</p>
                </a>
              </li>
              
            </ul>
          </li>
          
           <li class="nav-item">
            <a href="#" class="nav-link">
          
              <p>
                Manage Vendor
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('admin/manage_vendor')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All vendors</p>
                </a>
              </li>
              <!-- <li class="nav-item">-->
              <!--  <a href="{{ url('admin/manageexisting_user')}}" class="nav-link">-->
              <!--    <i class="far fa-circle nav-icon"></i>-->
              <!--    <p>Existing User</p>-->
              <!--  </a>-->
              <!--</li>-->
              
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
             
              <p>
                Manage Driver
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
              <li class="nav-item">
                <a href="{{ url('admin/manageexisting_drivers')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Existing Driver</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="{{ url('admin/managenew_drivers')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>New Driver</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="{{ url('admin/managerejected_driverlist')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Rejected Drivers</p>
                </a>
              </li>
               
              <!-- <li class="nav-item">-->
              <!--  <a href="{{ url('admin/sub-category/listing')}}" class="nav-link">-->
              <!--    <i class="far fa-circle nav-icon"></i>-->
              <!--    <p>Sub Category</p>-->
              <!--  </a>-->
              <!--</li>-->
              
            </ul>
          </li>
          <!--<li class="nav-item">-->
          <!--  <a href="#" class="nav-link">-->
            
          <!--    <p>-->
          <!--      Manage Seller-->
          <!--      <i class="fas fa-angle-left right"></i>-->
          <!--    </p>-->
          <!--  </a>-->
          <!--  <ul class="nav nav-treeview">-->
          <!--    <li class="nav-item">-->
          <!--      <a href="{{ url('admin/sales-person/listing')}}" class="nav-link">-->
          <!--        <i class="far fa-circle nav-icon"></i>-->
          <!--        <p>New Seller</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--     <li class="nav-item">-->
          <!--      <a href="{{ url('admin/sub-category/listing')}}" class="nav-link">-->
          <!--        <i class="far fa-circle nav-icon"></i>-->
          <!--        <p>Existing Seller</p>-->
          <!--      </a>-->
          <!--    </li>-->
              
          <!--  </ul>-->
          <!--</li>-->
          
          
           <li class="nav-item">
                <a href="#" class="nav-link">
                
                  <p>
                    Manage Service Provider
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  
                  <li class="nav-item">
                    <a href="{{ url('admin/exist_serviceprovider')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Existing Service Provider</p>
                    </a>
                  </li>
                  
                  <li class="nav-item">
                    <a href="{{ url('admin/new_serviceprovider')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>New Service Provider</p>
                    </a>
                  </li>
                  
                   <li class="nav-item">
                    <a href="{{ url('admin/managerejectedservice_providerlist')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Rejected Service Provider</p>
                    </a>
                  </li>
                  
                   
                  
                </ul>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
              
              <p>
                Manage Country,State,City
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('admin/country/listing')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Countries</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="{{ url('admin/states/listing')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>States</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('admin/cities/listing')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cities</p>
                </a>
              </li>
              
            </ul>
          </li>


          <li class="nav-item">
            <a href="#" class="nav-link">
              
              <p>
                Manage Products
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('admin/manage_product')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Products</p>
                </a>
              </li>

               <!-- <li class="nav-item">
                <a href="{{ url('admin/managesubcategory/listing')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sub Category</p>
                </a>
              </li> -->
              
            </ul>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
              
              <p>
                Manage Category & SubCategory
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('admin/managecategory/listing')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Category</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="{{ url('admin/managesubcategory/listing')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sub Category</p>
                </a>
              </li>
              
            </ul>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
              
              <p>
                Manage Order
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('admin/order/in-process/listing')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pending</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="{{ url('admin/order/completed_orders/listing')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Completed</p>
                </a>
              </li>
              <!--<li class="nav-item">-->
              <!--  <a href="{{ url('admin/order/canceled')}}" class="nav-link">-->
              <!--    <i class="far fa-circle nav-icon"></i>-->
              <!--    <p>Cancelled</p>-->
              <!--  </a>-->
              <!--</li>-->
            </ul>
          </li>




          <li class="nav-item">
            <a href="#" class="nav-link">
              
              <p>
                Manage Service Orders
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="{{ url('admin/serviceorder/in-process/listing')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pending</p>
                </a>
              </li>
              
               <li class="nav-item">
                <a href="{{ url('admin/serviceorder/completed_serviceorders/listing')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Completed</p>
                </a>
              </li>
               <li class="nav-item">
              <a href="{{ url('admin/serviceorder/cancelled_serviceorders/listing')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Cancelled</p>
              <!-- <i class="far fa-circle nav-icon"></i>
                 <p>Cancelled</p> -->
              </a>
            </li> 
            </ul>
          </li>
          
          
          
          <li class="nav-item">
            <a href="#" class="nav-link">
              
              <p>
                Manage Service Category
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('admin/manageservicecategory_list')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Service Categories</p>
                </a>
              </li>
              
            </ul>
          </li>
          
          
         <li class="nav-item">
            <a href="#" class="nav-link">
              
              <p>
                Manage Withdrawl Request
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Withdrawl Request</p>
                </a>
              </li>
              
            </ul>
          </li>
          
          
          
          <!--<li class="nav-item">-->
          <!--  <a href="#" class="nav-link">-->
             
          <!--    <p>-->
          <!--      Manage Inventory-->
          <!--      <i class="fas fa-angle-left right"></i>-->
          <!--    </p>-->
          <!--  </a>-->
          <!--  <ul class="nav nav-treeview">-->
          <!--    <li class="nav-item">-->
          <!--      <a href="{{ url('admin/inventory/listing')}}" class="nav-link">-->
          <!--        <i class="far fa-circle nav-icon"></i>-->
          <!--        <p>Listing</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--     <li class="nav-item">-->
          <!--      <a href="{{ url('admin/inventory/out-of-stock')}}" class="nav-link">-->
          <!--        <i class="far fa-circle nav-icon"></i>-->
          <!--        <p>Out of stock</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
          <!--      <a href="{{ url('admin/inventory/tranding')}}" class="nav-link">-->
          <!--        <i class="far fa-circle nav-icon"></i>-->
          <!--        <p>Tranding Product</p>-->
          <!--      </a>-->
          <!--    </li>-->
              
          <!--  </ul>-->
          </li>
          
          <!--<li class="nav-item">-->
          <!--  <a href="#" class="nav-link">-->
          
          <!--    <p>-->
          <!--      Manage Sub admin-->
          <!--      <i class="fas fa-angle-left right"></i>-->
          <!--    </p>-->
          <!--  </a>-->
          <!--  <ul class="nav nav-treeview">-->
          <!--    <li class="nav-item">-->
          <!--      <a href="{{ url('admin/sub-admin/listing')}}" class="nav-link">-->
          <!--        <i class="far fa-circle nav-icon"></i>-->
          <!--        <p>Listing</p>-->
          <!--      </a>-->
          <!--    </li>-->
              
              
          <!--  </ul>-->
          <!--</li>-->
          <!--<li class="nav-item">-->
          <!--  <a class="nav-link" href="{{ url('admin/commission/listing')}}">-->
          <!--    <i class="fas fa-fw fa-table"></i>-->
          <!--    <span>commission</span>-->
          <!--  </a>-->
          <!--</li>-->
          
          <!--<li class="nav-item">-->
          <!--  <a class="nav-link" href="{{ url('admin/notification/listing')}}">-->
          <!--    <i class="fas fa-fw fa-table"></i>-->
          <!--    <span>Notification</span>-->
          <!--  </a>-->
          <!--</li>-->
          <!--<li class="nav-item">-->
          <!--  <a href="#" class="nav-link">-->
          <!--    <p> Customer Support<i class="right fas fa-angle-left"></i></p>-->
          <!--  </a>-->
          <!--  <ul class="nav nav-treeview">-->
             
          <!--     <li class="nav-item">-->
          <!--      <a href="{{ url('/admin/feedback/listing') }}" class="nav-link">-->
          <!--      <i class="fas fa-address-book"></i>-->
          <!--        <p> Reply To Feedback </p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--      <li class="nav-item">-->
          <!--      <a href="{{ url('/admin/customer-query/listing') }}" class="nav-link">-->
          <!--      <i class="fas fa-address-book"></i>-->
          <!--        <p> Reply To Query </p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--  </ul>-->
          <!--</li>-->


          <li class="nav-item">
            <a href="#" class="nav-link">
              
              <p>
               Manage CMS
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
             
               <li class="nav-item">
                <a href="{{ url('/admin/contactus/update') }}" class="nav-link">
              
                <i class="fas fa-address-book"></i>
                  <p>contact-us</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="{{ url('/admin/about-us/update') }}" class="nav-link">
              
                <i class="fas fa-address-book"></i>
                  <p>About-us</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="{{ url('/admin/termscondition/update') }}" class="nav-link">
              
                <i class="fas fa-address-book"></i>
                  <p>Terms & Condition</p>
                </a>
              </li>
           
            
            </ul>
          </li>
          
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>