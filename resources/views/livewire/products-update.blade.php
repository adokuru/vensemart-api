


<div>
    
    <div wire:ignore.self id="updateModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
    <div class="modal-body">
                <form>
    <!-- <div class="form-group">
        <label for="todo_id">Trader name</label>
        <input type="text" class="form-control" placeholder="Trader name" wire:model="todo_id">
        @error('todo_id') <span class="text-danger">{{ $message }}</span> @enderror
    </div> -->
    
    
   

    <!-- <div class="form-group">-->
    <!-- <label for="option_type">Option</label>-->
    <!--    <input type="text" class="form-control" placeholder="payment" wire:model="payment">-->
    <!--    @error('payment') <span class="text-danger">{{ $message }}</span> @enderror-->
    <!--</div>-->

    
    
   
    
    <div class="form-group">
    <label for="quantity">Quantity</label>
       <input type="text" class="form-control" placeholder="quantity" wire:model="quantity">
        @error('amount') <span class="text-danger">{{ $message }}</span> @enderror
    </div> 



    <div class="form-check mt-2 mb-2">
   
   <input class="form-check-input" type="checkbox"  wire:model="status" id="flexCheckDefault" >
   <label class="form-check-label" for="flexCheckDefault">
     Product In Stock? (<small>tick for yes</small>)
   </label>
 </div>


    <!--<div class="form-group">-->
    <!--<label for="minimum_deposit">Amount</label>-->
    <!--    <input type="text" class="form-control" placeholder="amount" wire:model="amount">-->
    <!--    @error('amount') <span class="text-danger">{{ $message }}</span> @enderror-->
    <!--</div> -->

    <!--<div class="form-group">-->
    <!--<label for="start date">start date</label>-->
    <!--    <input type="date" class="form-control" placeholder="start_date" wire:model="start_time">-->
    <!--    @error('start_date') <span class="text-danger">{{ $message }}</span> @enderror-->
    <!--</div> -->

    <!--<div class="form-group">-->
    <!--<label for="end date">end date</label>-->
    <!--    <input type="date" class="form-control" placeholder="end_date" wire:model="end_time">-->
    <!--    @error('end_date') <span class="text-danger">{{ $message }}</span> @enderror-->
    <!--</div> -->
    
   
   



<!-- 
<div class="form-check mt-4 mb-2">
  <input class="form-check-input" type="checkbox"  wire:model="requested_end" id="flexCheckDefault" >
  <label class="form-check-label" for="flexCheckDefault">
    End Request Status
  </label>
</div> -->



    @if(session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif
                    <button wire:click.prevent="update()" class="btn btn-dark">Update</button>
                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
    
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    
    
</div>
    
    
    
    
</div>
