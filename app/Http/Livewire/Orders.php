<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Orders as Order;
use App\Models\EshopPurchaseDetail;
use App\Models\TodoInvestment;
use App\Models\Plantoken;

use App\Models\Stores;


class Orders extends Component
{


    use WithFileUploads;
    public $data_id,
    $fileTitle, $fileName,$deposit_amount,$result_date,$uploads, $minings,
    $earning_date,$option_type,$Volume,$Avg_volume,$market_cap,$minimum_investment,
    $minimum_deposit,$number_of_investors, $avg_profit_24;
  
    /**
     * Write code on Method
     *
     * @return response()
     */

     
     public function edit($id)
    {
        
 
        $data = Todo::findOrFail($id);
        $this->data_id = $id;
        $this->fileTitle = $data->fileTitle;
        $this->fileName = $data->fileName;
        $this->option_type = $data->option_type;
        $this->minimum_deposit = $data->minimum_deposit;
        $this->number_of_investors = $data->number_of_investors;
        $this->avg_profit_24 = $data->avg_profit_24;
    }


    public function show($id)
    {
        // get the shark
        $this->mining = Todo::find($this->data_id);
        

        
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



        $data = Todo::find($this->data_id);

        $data->update([
           
        'fileTitle' => $this->fileTitle,
        'fileName' => $this->fileName,
        'option_type' => $this->option_type,
        'minimum_deposit' => $this->minimum_deposit,
        'number_of_investors' => $this->number_of_investors,
        'avg_profit_24' => $this->avg_profit_24,

        
        ]);

        session()->flash('message', 'Stock Data Updated Successfully.');

        // $this->resetInputFields();

    }

    public function delete($id)
    {
        

        Todo::find($id)->delete();
        session()->flash('message', 'Data Deleted Successfully.');

    }


    public function submit()
    {
        
        $dataValid = $this->validate([
        'fileTitle' => 'required',
        'fileName' => 'required|image|mimes:jpg,jpeg,png,svg,gif|max:2048',
        'option_type' => 'required',
         'minimum_deposit' => 'required',
         'number_of_investors' => 'required',
         'avg_profit_24' => 'required',
          
        
        ]);
        
        $destinationPath = 'public/todos'; 

        $extension = $this->fileName->getClientOriginalExtension(); 

        $fileName = $this->fileTitle . '.' . $extension;

        $dataValid['fileName'] = $this->fileName->storeAs($destinationPath, $fileName,'public');
        
        Todo::create($dataValid);
  
        session()->flash('message', 'File uploaded.');
    }


    public function render()
    {


        $store = Stores::where('franchise_id', auth()->user()->user_id)->first();
        $storeId =  $store->id;


       
    


        // $this->minings = EshopPurchaseDetail::where('seller_id',$store->id)->get();

        $this->minings = EshopPurchaseDetail::query()
        ->leftJoin('users', 'eshop_purchase_detail.user_id', '=', 'users.id')
        ->select('eshop_purchase_detail.*', 'users.name as user_name')
        ->where('seller_id',$store->id)
        ->get();

        

        // $this->minings = EshopPurchaseDetail::all();
        return view('livewire.orders');
    }
}
