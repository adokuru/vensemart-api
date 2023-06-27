<div>
    
     <form wire:submit.prevent="register" enctype="multipart/form-data">

         {{-- STEP 1 --}}

         @if ($currentStep == 1)
             
<!-- 
    public $first_name;
    public $last_name;
    public $address;
    public $city;
    public $state;
    public $country;
    public $telephone;
    public $email;
    public $username;
    public $ref_id;
    public $lendmark;
    public $zipcode;
    public $admin_status;
    public $user_status;
    public $registration_date;
    public $image;
    public $acc_name;
    public $ac_no;
    public $bank_nm;
    public $branch_nm;
    public $swift_code;
    public $last_login_date;
    public $current_login_date;
    public $id_card;
    public $id_no;
    public $kyc_status;
    public $activation_date;
    public $franchise_category;
    public $franchise_satus;
    public $is_verified;
    public $gst;
    public $lati;
    public $longi;
    public $merried_status;
    public $gender; -->
      
         <div class="step-one">
             <div class="card">
                 <div class="card-header bg-secondary text-white">STEP 1/4 - Store Details</div>
                 <div class="card-body">
                    
                     <div class="row">
                         <div class="col-md-12">


                         @if($store_image == 'Abuja' )

<span class="data-value">Please make sure Store logo is selected </span>
                    @else

                    
                    <span class="data-value">  <img width="120" height="100" src="{{ asset('/storage/shop_images/'.$store_image) }}" /></span>

                    @endif

                             
  <div class="form-group mt-4">
  <label for="Stakee">Store Name</label>
      <input type="text" class="form-control"  placeholder="store_name" wire:model.lazy="store_name" >
      @error('store_name') <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  
  <div class="form-group">
  <label for="fileName">Store Logo</label>
      <input type="file" accept="image/*" class="form-control" placeholder="store logo" wire:model.lazy="fileName" >
      @error('fileName') <span class="text-danger">{{ $message }}</span> @enderror
  </div>

                         </div>
                        
                     </div>
                    
             </div>
         </div>
         @endif

         {{-- STEP 2 --}}

         @if ($currentStep == 2)
             
        
         <div class="step-two">
             <div class="card">
                 <div class="card-header bg-secondary text-white">STEP 2/4 - Address</div>
                 <div class="card-body">
                     <div class="row">
                       




                     <!-- 'address', 'created_at', 'franchise_id', 
                     'lati', 'longi', 'status', 
                     'store_image', 'store_name',
                      'updated_at'
     -->




    


 </div>


  
 
 
  <div class="form-group">
  <label for="platform">Address</label>
      <input type="text" class="form-control" placeholder="address" wire:model.lazy="address">
      @error('platform') <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  
  <!-- <div class="form-group">
  <label for="last_name">Lati</label>
      <input type="text" class="form-control" placeholder="lati" wire:model.lazy="lati">
      @error('last_name') <span class="text-danger">{{ $message }}</span> @enderror
  </div>

  <div class="form-group">
  <label for="longi">Longitude</label>
      <input type="text" class="form-control" placeholder="long" wire:model.lazy="longi">
      @error('longi') <span class="text-danger">{{ $message }}</span> @enderror
  </div> -->


  <!-- <div class="form-group">
  <label for="Net">Roiu</label>
      <input type="text" class="form-control" placeholder="roiu" wire:model.lazy="roiu" >
      @error('roiu') <span class="text-danger">{{ $message }}</span> @enderror
  </div>

  <div class="form-group">
  <label for="add deposit">Add Deposit</label>
      <input type="text" class="form-control" placeholder="add_deposit" wire:model.lazy="add_deposit" >
      @error('roiu') <span class="text-danger">{{ $message }}</span> @enderror
  </div> -->

  
  
  

 
  


                        
  
  
  
  
  
                 </div>
             </div>
         </div>

         @endif
         {{-- STEP 3 --}}

         @if ($currentStep == 3)
             
     
         <div class="step-three">
             <div class="card">
                 <div class="card-header bg-secondary text-white">STEP 3/4 - Overview</div>
                 <div class="card-body">
                     Please ensure to have entered details correctly to avoid any mistakes

            
                 </div>
             </div>
         </div>
         @endif

         {{-- STEP 4 --}}
         @if ($currentStep == 4)
             
     
         <div class="step-four">
         @if(session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
          @endif
         
             <div class="card">
                 <div class="card-header bg-secondary text-white">STEP 4/4 - Store Overview</div>
                 <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">

                            <div class="nk-block nk-block-lg">
                                
            
                                        <div class="card card-preview">
                                            
                                            <div class="card-inner">
                                                
                                                 
                                                <div class="row g-gs">

                                                  
                                                    <div class="col-md-8">
                                                        <div class="tab-content">
                                                            <div class="tab-pane active" id="tabItem13">
                                                            
                                                <!-- .nk-block-head -->
                                                            <div class="nk-block">
                                                    <div class="nk-data data-list">
                                                        <div class="data-head">
                                                            <h6 class="overline-title">Basics</h6>
                                                        </div>

                                                        
                                                        
                                                        <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                                            <div class="data-col">
                                                                <span class="data-label">Store Name</span>
                                                                <span class="data-value">{{ $store_name }}</span>
                                                            </div>
                                                            <div class="data-col data-col-end"></div>
                                                        </div><!-- data-item -->


                                                        <!-- <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                                            <div class="data-col">
                                                                <span class="data-label">Company Logo</span>
                                                                 



                                            @if(auth()->user()->image == 'Abuja')

                                            <span class="data-value">Please make sure Company logo is selected </span>
                                                                @else

                                                                
                                                                <span class="data-value">  <img width="50" height="50" src="{{ asset('/storage/shop_images/'.$store_image) }}" /></span>

                                                                @endif
                                                            </div>
                                                            <div class="data-col data-col-end"></div>
                                                        </div>
                                                         -->
                                                        <!-- data-item -->


                                                        <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                                            <div class="data-col">
                                                                <span class="data-label">Address</span>
                                                                <span class="data-value">{{ $address }} </span>
                                                            </div>
                                                            <div class="data-col data-col-end">
                                                                <!--  -->
                                                            </div>
                                                        </div><!-- data-item -->

                                                       

                                                    
                                                        <!-- <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                                            <div class="data-col">
                                                                <span class="data-label">Phone Number</span>
                                                                <span class="data-value text-soft">{{ auth()->user()->phone_no }}</span>
                                                            </div>
                                                            <div class="data-col data-col-end"></div>
                                                        </div> -->
                                                        <!-- data-item -->
                                                        <!-- <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                                            <div class="data-col">
                                                                <span class="data-label">Date of Birth</span>
                                                                <span class="data-value">29 Feb, 1986</span>
                                                            </div>
                                                            <div class="data-col data-col-end"></div>
                                                        </div>data-item -->
                                                        <!-- <div class="data-item" data-toggle="modal" data-target="#profile-edit" data-tab-target="#address">
                                                            <div class="data-col">
                                                                <span class="data-label">Address</span>
                                                                <span class="data-value">2337 Kildeer Drive,<br>Kentucky, Canada</span>
                                                            </div>
                                                            <div class="data-col data-col-end"></div>
                                                        </div>data-item -->
                                                    </div><!-- data-list -->
                                                    <!-- <div class="nk-data data-list">
                                                        <div class="data-head">
                                                            <h6 class="overline-title">Preferences</h6>
                                                        </div>
                                                        <div class="data-item">
                                                            <div class="data-col">
                                                                <span class="data-label">Language</span>
                                                                <span class="data-value">English (United State)</span>
                                                            </div>
                                                            <div class="data-col data-col-end"><a href="#" data-toggle="modal" data-target="#profile-language" class="link link-primary">Change Language</a></div>
                                                        </div> -->
                                                        <!-- data-item -->
                                                        <!-- <div class="data-item">
                                                            <div class="data-col">
                                                                <span class="data-label">Date Format</span>
                                                                <span class="data-value">M d, YYYY</span>
                                                            </div>
                                                            <div class="data-col data-col-end"><a href="#" data-toggle="modal" data-target="#profile-language" class="link link-primary">Change</a></div>
                                                        </div>data-item -->
                                                        <!-- <div class="data-item">
                                                            <div class="data-col">
                                                                <span class="data-label">Timezone</span>
                                                                <span class="data-value">Bangladesh (GMT +6)</span>
                                                            </div>
                                                            <div class="data-col data-col-end"><a href="#" data-toggle="modal" data-target="#profile-language" class="link link-primary">Change</a></div>
                                                        </div>data-item -->
                                                    </div><!-- data-list -->
                                                </div><!-- .nk-block -->
                                                          
                                                            
                                                            
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- .card-preview -->
                                
                            </div>
                        </div>
                    </div>
             </div>
             </div>
         </div>

         @endif

         <div class="action-buttons d-flex justify-content-between bg-white pt-2 pb-2">

            @if ($currentStep == 1)
                <div></div>
            @endif

            @if ($currentStep == 2 || $currentStep == 3 || $currentStep == 4)
            <button type="button" class="btn btn-md btn-secondary" wire:click="decreaseStep()">Back</button>
            @endif
            
            @if ($currentStep == 1 || $currentStep == 2 || $currentStep == 3)
                <button type="button" wire:loading.attr="disabled" wire:loading.class="invisible" class="btn btn-md btn-success" wire:click="increaseStep()">Next</button>
                <div wire:loading>
                    <p>loading....please wait</p>
        <!-- <img src="/path/to/spinner.gif" alt="Processing Payment..."> -->
    </div>
            @endif
            
            @if ($currentStep == 4)
           
                 <button type="submit" wire:loading.attr="disabled" wire:loading.class="invisible" class="btn btn-md btn-primary">Confirm Details</button>
                 
                <!-- Creat Countdown Timer -->
  

                 
<script>
         var h3 = document.getElementsByTagName("h3");
h3[0].innerHTML = "";

var sec         = 1800,
    countDiv    = document.getElementById("timer"),
    secpass,
    countDown   = setInterval(function () {
        'use strict';
        
        secpass();
    }, 1000);

function secpass() {
    'use strict';
    
    var min     = Math.floor(sec / 60),
        remSec  = sec % 60;
    
    if (remSec < 10) {
        
        remSec = '0' + remSec;
    
    }
    if (min < 10) {
        
        min = '0' + min;
    
    }
    countDiv.innerHTML = min + ":" + remSec;
    
    if (sec > 0) {
        
        sec = sec - 1;
        
    } else {
        
        clearInterval(countDown);
        
        countDiv.innerHTML = 'countdown done';
        
    }
}

                 </script>
            @endif
                
               
         </div>

     </form>


</div>