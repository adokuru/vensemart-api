<div>
    
     <form wire:submit.prevent="register">

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
                 <div class="card-header bg-secondary text-white">STEP 1/4 - Personal Details</div>
                 <div class="card-body">
                    
                     <div class="row">
                         <div class="col-md-12">

                         <div class="form-group">
  <label for="first_name">First Name</label>
      <input type="text" class="form-control" placeholder="firstname" wire:model="first_name">
      @error('first_name') <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  
  <div class="form-group">
  <label for="last_name">Last Name</label>
      <input type="text" class="form-control" placeholder="last_name" wire:model="last_name">
      @error('last_name') <span class="text-danger">{{ $message }}</span> @enderror
  </div>

  <div class="form-group">
  <label for="email">Email</label>
      <input type="text" class="form-control" placeholder="email" wire:model="email" >
      @error('email') <span class="text-danger">{{ $message }}</span> @enderror
  </div>


  <div class="form-group">
  <label for="telephone">Telephone</label>
      <input type="text" class="form-control" placeholder="telephone" wire:model="telephone" >
      @error('roiu') <span class="text-danger">{{ $message }}</span> @enderror
  </div>





  
  <div class="form-group">
  <label for="gender">Gender</label>
      <input type="text" class="form-control" placeholder="gender" wire:model="gender" >
      @error('roiu') <span class="text-danger">{{ $message }}</span> @enderror
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
                 <div class="card-header bg-secondary text-white">STEP 2/4 - User Details</div>
                 <div class="card-body">
                     <div class="row">
                       


                     <!-- 'address' => 'plot 360',
                'city' => 'Abuja',
                'state' => 'Abuja',
                'country' => 'Nigeria',
                'telephone' => '08033994499',
                'email' => 'Candar@gmail.com',
                'username' => 'Candar@gmail.com',
                'user_id' => 1000,
                'ref_id' => 1000,
                'lendmark' => 'Abuja',
                 'zipcode'  => 'Abuja',
                 'admin_status'=> 1,
                 'user_status' => 'Abuja',
                 'registration_date'=> 'Abuja',
                'image'=> 'Abuja',
                'acc_name'=> 'Abuja',
                'ac_no'=> 'Abuja',
                'bank_nm'=> 'Abuja',
                'branch_nm'=> 'Abuja',
                'swift_code'=> 'Abuja',
                'last_login_date'=> 'Abuja',
                'current_login_date'=> 'Abuja',
                'id_card'=> 'Abuja',
                'id_no'=> 'Abuja',
                'kyc_status'=> 1,
                'activation_date'=> 'Abuja',
                'franchise_category'=> 'Abuja',
                'franchise_satus'=> 1,
                'is_verified'=> 1,
                'gst'=> 'Abuja',
                'lati'=> 'Abuja',
                'longi'=> 'Abuja',
                'merried_status'=> 'Abuja',
                'gender'=> 'Abuja',
                 -->




                






    


 </div>


  
 
 
 

  <div class="form-group">
  <label for="address">Address</label>
      <input type="text" class="form-control" placeholder="address" wire:model="address">
      @error('address') <span class="text-danger">{{ $message }}</span> @enderror
  </div>

  <div class="form-group">
  <label for="city">City</label>
      <input type="text" class="form-control" placeholder="city" wire:model="city" >
      @error('city') <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  
  <div class="form-group">
  <label for="Net">State</label>
      <input type="text" class="form-control" placeholder="state" wire:model="state" >
      @error('net') <span class="text-danger">{{ $message }}</span> @enderror
  </div>


  <div class="form-group">
  <label for="Net">Country</label>
      <input type="country" class="form-control" placeholder="country" wire:model="country" >
      @error('roiu') <span class="text-danger">{{ $message }}</span> @enderror
  </div>






  
  
  
                 </div>
             </div>
         </div>

         @endif
         {{-- STEP 3 --}}

         @if ($currentStep == 3)
             
     
         <div class="step-three">
             <div class="card">
                 <div class="card-header bg-secondary text-white">STEP 3/4 - Bank Details</div>
                 <div class="card-body">
                     
                 <!-- 'acc_name'=> 'Abuja',
                'ac_no'=> 'Abuja',
                'bank_nm'=> 'Abuja',
                'branch_nm'=> 'Abuja',
                'swift_code'=> 'Abuja', -->

                     <div class="form-group">
  <label for="acc_name">Account Name</label>
      <input type="text" class="form-control" placeholder="acc_name" wire:model="acc_name" >
      @error('acc_name') <span class="text-danger">{{ $message }}</span> @enderror
  </div>


  <div class="form-group">
  <label for="ac_no">Account Number</label>
      <input type="text" class="form-control" placeholder="ac_no" wire:model="ac_no" >
      @error('roiu') <span class="text-danger">{{ $message }}</span> @enderror
  </div>

  

  <div class="form-group">
  <label for="bank_nm">Bank Name</label>
      <input type="text" class="form-control" placeholder="bank_nm" wire:model="bank_nm" >
      @error('bank_nm') <span class="text-danger">{{ $message }}</span> @enderror
  </div>


  <div class="form-group">
  <label for="branch_nm">Branch Name</label>
      <input type="text" class="form-control" placeholder="branch_nm" wire:model="branch_nm" >
      @error('roiu') <span class="text-danger">{{ $message }}</span> @enderror
  </div>



            
                 </div>
             </div>
         </div>
         @endif

         {{-- STEP 4 --}}
         @if ($currentStep == 4)
             
     
         <div class="step-four">
             <div class="card">
                 <div class="card-header bg-secondary text-white">STEP 4/4 - Address Details</div>
                 <div class="card-body">
                    


                     <div class="form-group">
  <label for="add deposit">Account Name</label>
      <input type="text" class="form-control" placeholder="add_deposit" wire:model="add_deposit" >
      @error('roiu') <span class="text-danger">{{ $message }}</span> @enderror
  </div>


  <div class="form-group">
  <label for="add deposit">Bank</label>
      <input type="text" class="form-control" placeholder="add_deposit" wire:model="add_deposit" >
      @error('roiu') <span class="text-danger">{{ $message }}</span> @enderror
  </div>

  

  <div class="form-group">
  <label for="add deposit">Bank Name</label>
      <input type="text" class="form-control" placeholder="add_deposit" wire:model="add_deposit" >
      @error('roiu') <span class="text-danger">{{ $message }}</span> @enderror
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
            <a wire:click="decreaseStep()" class="btn btn-outline-light bg-white d-none d-sm-inline-flex"><em class="icon ni ni-arrow-left"></em><span>Back</span></a>
            @endif
            
            @if ($currentStep == 1 || $currentStep == 2 || $currentStep == 3)
                <button type="button" class="btn btn-md btn-success" wire:click="increaseStep()">Next</button>
            @endif
            
            @if ($currentStep == 4)
           
                 <button type="submit" class="btn btn-md btn-primary">Finish</button>
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