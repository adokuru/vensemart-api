<div>
    
     <form wire:submit.prevent="register" enctype="multipart/form-data">

         {{-- STEP 1 --}}

         @if ($currentStep == 1)
             

      
         <div class="step-one">
            <div class="card">
                <div class="card-header bg-secondary text-white">STEP 1/2 - Bank Details</div>
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

       

         {{-- STEP 2 --}}
         @if ($currentStep == 2)
             
     
         <div class="step-two">
         @if(session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
          @endif
         
             <div class="card">
                 <div class="card-header bg-secondary text-white">STEP 2/2 - Overview</div>

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
                                                                <span class="data-label">Account  Name</span>
                                                                <span class="data-value">{{$first_name}}</span>
                                                            </div>
                                                            <div class="data-col data-col-end"></div>
                                                        </div><!-- data-item -->

                                                       

                                                        <div class="data-item">
                                                            <div class="data-col">
                                                                <span class="data-label">Account Number</span>
                                                                <span class="data-value">{{ $email }} 88888</span>
                                                            </div>
                                                            <div class="data-col data-col-end"><span class="data-more disable"><em class="icon ni "></em></span></div>
                                                        </div><!-- data-item -->


                                                        <!-- <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                                            <div class="data-col">
                                                                <span class="data-label">Display Picture</span>
                                                                
                                                                <span class="data-value"><img width="50" height="50" src="{{ asset('/storage/vendor_images/'.$image) }}" /></span>
                                                            </div>
                                                            <div class="data-col data-col-end"></div>
                                                        </div> -->
                                                        <!-- data-item -->

                                                        <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                                            <div class="data-col">
                                                                <span class="data-label">Bank Name</span>
                                                                <span class="data-value">{{ $address }}</span>
                                                            </div>
                                                            <div class="data-col data-col-end"></div>
                                                        </div><!-- data-item -->

                                                        <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                                            <div class="data-col">
                                                                <span class="data-label">Branch</span>
                                                                <span class="data-value">{{ $bank_nm }} branch</span>
                                                            </div>
                                                            <div class="data-col data-col-end"></div>
                                                        </div><!-- data-item -->
                                                        



                                                        <!-- <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                                            <div class="data-col">
                                                                <span class="data-label">Phone Number</span>
                                                                <span class="data-value text-soft">{{ $telephone }}</span>
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
            <button type="button" class="btn btn-md btn-success" wire:click="increaseStep()">Next</button>
            @endif

            @if ($currentStep == 2)
            <button type="button" class="btn btn-md btn-secondary" wire:click="decreaseStep()">Back</button>
            @endif
            
            @if ( $currentStep == 2)
            <button type="submit" class="btn btn-md btn-primary">Confirm Details</button>
            @endif
            
          

                
               
         </div>

     </form>


</div>