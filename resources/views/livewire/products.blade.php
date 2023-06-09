

<div>
    @if(session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    

    @include('livewire.products-update')
    <br />
    <div class="card card-bordered card-preview">
                  <table class="table table-tranx">
                                                <thead>
                                                    <tr class="tb-tnx-head">
                                                        <th class="tb-tnx-id"><span class="">Product Title</span></th>
                                                        <th class="tb-tnx-info">
                                                            <span class="tb-tnx-desc d-none d-sm-inline-block">
                                                                <span> Price</span>
                                                            </span>
                                                            <span class="tb-tnx-date d-md-inline-block d-none">
                                                                <span class="d-md-none">Plan name</span>
                                                                <span class="d-none d-md-block">
                                                                    <span>Quantity</span>
                                                                     <span>In Stock</span>
                                                                 </span>
                                                            </span> 
                                                        </th>
                                                      
                                                        
                                                        <th class="tb-tnx-action">
                                                            <span>&nbsp;</span>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                @foreach($minings as $data)
                                                    <tr class="tb-tnx-item">
                                                        <td class="tb-tnx-id">
                                                           
                                     <a href="#"><span>
                                      <!-- <div class="nk-tnx-type-icon bg-success-dim text-success">
                                       <em class="icon ni ni-arrow-up-right"></em>
                                      </div> -->
                                      {{ $data->product_title ?? '' }}</span></a>
                                                        </td>
                                                        <td class="tb-tnx-info">
                                                            <div class="tb-tnx-desc">
                                                                <span class="title"><s>&#8358;{{ $data->product_price }}</s></span>
                                                                <span class="title">&#8358;{{ $data->discount }}</span>
                                                            </div>
                                                            <div class="tb-tnx-date">
                                                                 <span class="date">{{  $data->quantity }}</span> 
                                                                 <span class="date">@if($data->status == '1')
                                                                <span class="badge badge-dot badge-success">In Stock</span>
                                                                @else
                                                                  <span class="badge badge-dot badge-warning">Out of Stock</span>
                                                                  
                                                                  @endif</span> 
                                                             </div> 
                                                        </td>

                  
                                                       

                                                        


                                                        <td class="tb-tnx-action">
                                                            <div class="dropdown">
                                                                <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-forward-arrow-fill"></em></a>
                                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                                                                    <ul class="link-list-plain">
                                                                        <li>
                                                                        <button data-toggle="modal" data-target="#updateModal" class="btn btn-primary btn-sm" wire:click="edit({{ $data->id }})">Manage</button>
                                                                        </li>

                                                                        <li> 
                                                                           
                                <button wire:click="delete({{ $data->id }})" class="btn btn-danger btn-sm">Delete</button>
                </li>
                                                                        <!-- <li><a href="#">Edit</a></li>
                                                                        <li><a href="#">Remove</a></li> -->
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        

                                                        
                                                        
                                                    </tr>

                                                    @endforeach
                                                    
                                                </tbody>
                                            </table>
                                        
                                        </div>


    

    
</div>















                                            