<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Todo;
use App\Models\TodoInvestment;
use App\Models\Plantoken;


class Store extends Component
{
    use WithFileUploads;
    public $data_id,$fileTitle, $fileName,$price,
    $result_date,$uploads, $minings,
    $earning_date,$option_type,$Volume,$Avg_volume,
    $market_cap,$minimum_investment,$deposit_amount,
    $minimum_deposit,$number_of_investors,$avg_profit_24;
  
    /**
     * Write code on Method
     *
     * @return response()
     */

     
     public function edit($id)
    {
        
        $data = Plantoken::findOrFail($id);
        $this->data_id = $id;
        $this->fileTitle = $data->fileTitle;
        $this->fileName = $data->fileName;
        $this->price = $data->price;
        $this->minimum_deposit = $data->minimum_deposit;
        $this->number_of_investors = $data->number_of_investors;
        $this->avg_profit_24 = $data->avg_profit_24;
        
    }


    public function show($id)
    {
        // get the shark
        $this->mining = Plantoken::find($this->data_id);
        

        
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

        $data = Plantoken::find($this->data_id);

        $data->update([
           
        'fileTitle' => $this->fileTitle,
        'fileName' => $this->fileName,
        'price' => $this->price,
        'minimum_deposit' => $this->minimum_deposit,
        'number_of_investors'=> $this->number_of_investors,
        'avg_profit_24' => $this->avg_profit_24,
        
        
        ]);

        session()->flash('message', 'Stock Data Updated Successfully.');

        // $this->resetInputFields();

        $this->emit('TodoStore');
    }

    public function delete($id)
    {
        Plantoken::find($id)->delete();
        session()->flash('message', 'Data Deleted Successfully.');
    }



    public function render()
    {
        $this->minings = Plantoken::all();

        return view('livewire.store');
    }
}
