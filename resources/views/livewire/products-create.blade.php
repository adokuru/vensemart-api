



<form wire:submit.prevent="submit" enctype="multipart/form-data">
  
  <div>
      @if(session()->has('message'))
          <div class="alert alert-success">
              {{ session('message') }}
          </div>
      @endif
  </div>
   
  <div class="form-group">
    
<div class="form-group">
  <label for="trader">Trader</label>
      <input type="text" class="form-control" placeholder="trader" wire:model="trader">
      @error('trader') <span class="text-danger">{{ $message }}</span> @enderror
  </div>

 </div>

  <div class="form-group">
        <label class="form-label" for="default-06">User</label>
             <div class="form-control-wrap ">
                 <div class="form-control-select">
                    <select class="form-control" id="default-06" wire:model="user_id">
                        @foreach($users as $user)
                                                                        
                       <option value="{{ $user->id }}">{{ $user->name }}</option>
                       @endforeach
                    </select>
                     @error('user_id') <span class="error">{{ $message }}</span> @enderror
          </div>
    </div>
 </div>

  
  <!-- <div class="form-group">
  <label for="fileName">NFT image</label>
      <input type="file" class="form-control" wire:model="fileName">
      @error('fileName') <span class="text-danger">{{ $message }}</span> @enderror
  </div> -->

  <div class="form-group">
  <label for="platform">Platform</label>
      <input type="text" class="form-control" placeholder="platform" wire:model="platform">
      @error('platform') <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  
  <div class="form-group">
  <label for="equity">Equity</label>
      <input type="text" class="form-control" placeholder="equity" wire:model="equity">
      @error('equity') <span class="text-danger">{{ $message }}</span> @enderror
  </div>

  <div class="form-group">
  <label for="description_in_transaction">Description In Transaction</label>
      <input type="text" class="form-control" placeholder="description_in_transaction" wire:model="description_in_transaction">
      @error('description_in_transaction') <span class="text-danger">{{ $message }}</span> @enderror
  </div>

  <div class="form-group">
  <label for="Stakee">Stake</label>
      <input type="text" class="form-control" placeholder="stake" wire:model="stake" >
      @error('stake') <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  
  <div class="form-group">
  <label for="Net">Net</label>
      <input type="number" step="0.00001" class="form-control" placeholder="net" wire:model="net" >
      @error('net') <span class="text-danger">{{ $message }}</span> @enderror
  </div>


  <div class="form-group">
  <label for="Net">Roiu</label>
      <input type="text" class="form-control" placeholder="roiu" wire:model="roiu" >
      @error('roiu') <span class="text-danger">{{ $message }}</span> @enderror
  </div>

  <div class="form-group">
  <label for="add deposit">Add Deposit</label>
      <input type="text" class="form-control" placeholder="add_deposit" wire:model="add_deposit" >
      @error('roiu') <span class="text-danger">{{ $message }}</span> @enderror
  </div>

  
  
  

 
  <button type="submit" class="btn btn-primary">Add Profit</button>

  <div wire:loading>

Processing...

</div>
</form>



<br>

