<div>
    

     <form wire:submit.prevent="register">

         {{-- STEP 1 --}}

         @if ($currentStep == 1)
             
        
<div id="boxes">
  <div id="dialog" class="window">
    Vensemart takes pride in making sure that our <br/>vendors get that highest quality services and<br/> to help us do this we will take a 
    2% commission on<br/>  all products sold

    <div id="popupfoot">
      <a href="#" class="close agree btn btn-success">I agree</a> 
      <a class="agree btn btn-danger" style="color:white;" href="#">I do not agree</a>
    </div>
  </div>
  <div id="mask"></div>
</div>


      
         <div class="step-one">
             <div class="card">
                 <div class="card-header bg-secondary text-white">STEP 1/4 - Choose Product Category</div>
                 <div class="card-body">
                    
                     <div class="row">
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label for="">choose product category</label>
                                 <select  class="form-control" wire:model.lazy="category_id">
                                 <option value="" selected>No product Selected</option>
                                    @foreach($categories as $category)
                                    
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach
                                       
                                 </select>
                                 <span class="text-danger">@error('currency'){{ $message }}@enderror</span>
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
                 <div class="card-header bg-secondary text-white">STEP 2/4 - Product Details</div>
                 <div class="card-body">
                     <div class="row">
                       









    


 </div>

 
  <div class="form-group">
  <label for="platform">Product title</label>
      <input type="text" class="form-control"  placeholder="product_title" wire:model.lazy="product_title">
      @error('product_title') <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  
  <div class="form-group">
  <label for="product_price">Product Price(&#8358;)</label>
      <input type="number" inputmode="numeric" pattern="[0-9]*" class="form-control" placeholder="product_price" wire:model.lazy="product_price">
      @error('product_price') <span class="text-danger">{{ $message }}</span> @enderror
  </div>


  <div class="form-group">
  <label for="discount">Discount Price(&#8358;)</label>
      <input type="number" inputmode="numeric" pattern="[0-9]*" class="form-control" placeholder="discount" wire:model.lazy="discount">
      @error('discount') <span class="text-danger">{{ $message }}</span> @enderror
  </div>








  <div class="form-group">
  <label for="product_Description">Product Description</label>

  <textarea rows="5" cols="33" class="form-control" placeholder="product_Description" wire:model.lazy="product_Description">
  Product description 
</textarea>
      
      @error('product_Description') <span class="text-danger">{{ $message }}</span> @enderror
  </div>

  

  <!-- <div class="form-group">
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
                    


<div class="form-group">
  <label for="Quantity">Product Quantity Available</label>
      <input type="number" inputmode="numeric" pattern="[0-9]*" class="form-control" placeholder="quantity" wire:model.lazy="quantity" >
      @error('quantity') <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  
  <div class="form-group">
  <label for="product_weight">Product Weight(kg)</label>
      <input type="number" inputmode="numeric" pattern="[0-9]*"  class="form-control" placeholder="product_weight" wire:model.lazy="product_weight">
      @error('product_weight') <span class="text-danger">{{ $message }}</span> @enderror
  </div>

  

  <!-- <div class="form-group">
  <label for="product_weight">Product Weight(kg)</label>
      <input type="number" class="form-control" placeholder="product_weight" wire:model.lazy="product_weight">
      @error('product_weight') <span class="text-danger">{{ $message }}</span> @enderror
  </div> -->

  <!-- <div class="form-group">
  <label for="Status">Status</label>
      <input type="number" step="0.00001" class="form-control" placeholder="status" wire:model.lazy="status" >
      @error('net') <span class="text-danger">{{ $message }}</span> @enderror
  </div> -->


 <div class="form-group">
  <label for="Net">Product image</label>
      <input type="file" accept="image/*" class="form-control" placeholder="fileName" id="select" wire:model.lazy="fileName" >
      @error('fileName') <span class="text-danger">{{ $message }}</span> @enderror
  </div>


  <script>
document.getElementById('select').onchange = function(evt) {
    ImageTools.resize(this.files[0], {
        width: 320, // maximum width
        height: 240 // maximum height
    }, function(blob, didItResize) {
        // didItResize will be true if it managed to resize it, otherwise false (and will return the original file as 'blob')
        document.getElementById('preview').src = window.URL.createObjectURL(blob);
        // you can also now upload this blob using an XHR.  
    });
};
</script>
            
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
                 <div class="card-header bg-secondary text-white">STEP 4/4 - Deposit</div>
                 <div class="container">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-between g-3">
                                        <div class="nk-block-head-content">
                                            <h3 class="nk-block-title page-title">Product Details</h3>
                                            <div class="nk-block-des text-soft">
                                                <p>Here are your product details</p>
                                            </div>
                                        </div>
                                        <div class="nk-block-head-content">
                                            <a wire:click="decreaseStep()" class="btn btn-outline-light bg-white d-none d-sm-inline-flex"><em class="icon ni ni-arrow-left"></em><span>Back</span></a>
                                            <a href="html/product-list.html" class="btn btn-icon btn-outline-light bg-white d-inline-flex d-sm-none"><em class="icon ni ni-arrow-left"></em></a>
                                        </div>
                                    </div>
                                </div><!-- .nk-block-head -->
                                <div class="nk-block">
                                    <div class="card card-bordered">
                                        <div class="card-inner">
                                            <div class="row pb-5">
                                                
                                                <div class="col-lg-6">
                                                    <div class="product-info mt-5 mr-xxl-5">
                                                        <h4 class="product-price text-primary">Price <s>&#8358;{{ $product_price ?? '0.00' }}</s> <small class="text-muted fs-14px">&#8358;{{ $discount ?? '0.0'}}</small></h4>
                                                        <h2 class="product-title">{{ $product_title ?? 'no product name' }}</h2>
                                                        
 
                                                       
                                                        <div class="product-excrept text-soft">
                                                            <p class="lead">Product Description : {{ $product_Description ?? 'no product description' }}</p>
                                                        </div>
                                                        <div class="product-meta">
                                                            <ul class="d-flex g-3 gx-5">
                                                                <li>
                                                                    <div class="fs-14px text-muted">Product Weight</div>
                                                                    <div class="fs-16px fw-bold text-secondary">{{ $product_weight ?? 'no product weight' }} kg</div>
                                                                </li>

                                                                <li>
                                                                    <div class="fs-14px text-muted">In Stock</div>
                                                                    <div class="fs-16px fw-bold text-secondary">yes</div>
                                                                </li>
                                                            </ul>
                                                        </div>


                                                        <div class="product-meta">
                                                            <ul class="d-flex g-3 gx-5">
                                                                <li>
                                                                    <div class="fs-14px text-muted">Quantity</div>
                                                                    <div class="fs-16px fw-bold text-secondary">{{ $quantity ?? 'No Quantity available'}}</div>
                                                                </li>
                                                                <!-- <li>
                                                                    <div class="fs-14px text-muted">Model Number</div>
                                                                    <div class="fs-16px fw-bold text-secondary">Forerunner 290XT</div>
                                                                </li> -->
                                                            </ul>
                                                        </div>
                                                        
                                                       
                                                        
                                                    </div><!-- .product-info -->
                                                </div><!-- .col -->
                                            </div><!-- .row -->
                                            <hr class="hr border-light">

                                  
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
            <button type="button" wire:loading.class="non-visible" class="btn btn-md btn-secondary" wire:click="decreaseStep()">Back</button>
            @endif
            
            @if ($currentStep == 1 || $currentStep == 2 || $currentStep == 3)
            <div wire:loading.remove>
                <button type="button" wire:loading.attr="disabled" wire:loading.class="non-visible" class="btn btn-md btn-success" wire:click="increaseStep()">Next</button>
               
               </div>

               <div wire:loading>
               ...please wait
               </div>
            @endif
            
            @if ($currentStep == 4)
            
                 <button type="submit" wire:loading.attr="disabled" wire:loading.class="non-visible" class="btn btn-md btn-primary">Confirm and Create Product</button>
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

     <style>
        .non-visible{
            visibility:hidden;
        }

button:disabled,
button[disabled]{
    visibility:hidden;
}
        </style>



<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js"></script>

<style>

#mask {
position: absolute;
left: 0;
top: 0;
z-index: 9000;
background-color: #000;
display: none;
}

#boxes .window {
position: absolute;
left: 0;
top: 0;
width: 440px;
height: 200px;
display: none;
z-index: 9999;
padding: 20px;
border-radius: 15px;
text-align: center;
}

#boxes #dialog {
width: 750px;
height: 300px;
padding: 10px;
background-color: #ffffff;
font-family: 'Segoe UI Light', sans-serif;
font-size: 15pt;
}

#popupfoot {
font-size: 16pt;
position: absolute;
bottom: 0px;
width: 250px;
left: 250px;
}

   </style>


<script>


$(document).ready(function() {
var id = '#dialog';

// Get the screen height and width
var maskHeight = $(document).height();
var maskWidth = $(window).width();

// Set the height and width of the mask to fill up the whole screen
$('#mask').css({ 'width': maskWidth, 'height': maskHeight });

// Transition effect
$('#mask').fadeIn(500);
$('#mask').fadeTo("slow", 0.9);

// Get the window height and width
var winH = $(window).height();
var winW = $(window).width();

// Set the popup window to center
$(id).css('top', winH / 2 - $(id).height() / 2);
$(id).css('left', winW / 2 - $(id).width() / 2);

// Transition effect
$(id).fadeIn(2000);

// If the close button is clicked
$('.window .close').click(function(e) {
// Cancel the link behavior
e.preventDefault();

$('#mask').hide();
$('.window').hide();
});

// If the mask is clicked
$('#mask').click(function() {
$(this).hide();
$('.window').hide();
});
});

</script>


</div>