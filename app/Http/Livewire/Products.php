<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Products as Product;
use App\Models\Stores;
use App\CoinInvestment;

class Products extends Component
{
    use WithFileUploads;
    public $data_id,$product_title, $product_price,$quantity,$in_stock,$uploads, $minings,
    $status,$option_type,$Volume,$Avg_volume,$market_cap,$minimum_investment,$deposit_amount,$minimum_deposit,$number_of_investors,$avg_profit_24;
  
    /**
     * Write code on Method
     *
     * @return response()
     */

     
     public function edit($id)
    {
        
        $data = Product::findOrFail($id);
        $this->data_id = $id;
        $this->product_title = $data->product_title;
        // $this->fileName = $data->fileName;
        $this->product_price = $data->product_price;
        $this->in_stock = $data->in_stock;
        $this->status = $data->in_status;
        $this->quantity = $data->quantity;
        // $this->avg_profit_24 = $data->avg_profit_24;
        
    }


    public function show($id)
    {
        // get the shark
        $this->mining = Product::find($this->data_id);
        

        
    }

    public function update()
    {
        // $validate = $this->validate([
            
        //     'fileTitle' => 'required',
        //     'deposit_amount' => 'required', 
        //     'result_date' => 'required',
        //     'earning_date' => 'required',
        //     'option_type' => 'required',
        //     'Volume' => 'required',
        //     'Avg_volume' => 'required',
        //     'market_cap' => 'required',
        //     'minimum_investment' => 'required',
    		
        // ]);

        $data = Product::find($this->data_id);
        if($this->status == 1){
            $this->in_stock = 'yes';

        }else{
            
            $this->in_stock = 'no';
        }

        $data->update([
           
        'product_price' => $this->product_price,
        'product_title' => $this->product_title,
        'quantity'=> $this->quantity,
        'in_stock' => $this->in_stock,
        'status' => $this->status,
        
        
        ]);

        session()->flash('message', 'Product Data Updated Successfully.');

        // $this->resetInputFields();

        $this->emit('TodoStore');
    }

    public function delete($id)
    {
        Product::find($id)->delete();
        session()->flash('message', 'Data Deleted Successfully.');
    }



    public function render()
    {

        $store = Stores::where('franchise_id', auth()->user()->user_id)->first();
        $storeId =  $store->id;

        $this->minings = Product::where('shop_id', $storeId)->orderBy('id', 'DESC')->get();
        return view('livewire.products');
    }
}
