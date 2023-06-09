<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CategoriesCreate extends Component
{


    public $user_id;
    public $todo_id;
    public $start_time;
    public $end_time;
    public $amount;
    public $currency;
    public $crypto_amount;
    public $trader,$platform, $equity, 
    $description_of_transaction, 
    $description_in_transaction,$stake,
     $net, $roiu, $add_deposit;
    public $todos,$minings,$users,$copytraders;
    public $data_id;

    public $usdt_balance,$todo,$status;


// protected $rules = [
//         'trader' => 'required',
//         'user_id' => 'required',
//     ];


public function mount (){
    
    $this->user_id = auth()->user()->id;
    $this->trader = '';
    $this->platform = '';
    $this->equity = '';
    $this->description_in_transaction = '';
    $this->stake = '';
    $this->net = '';
    $this->roiu = '';
    $this->add_deposit = '';
}
 
    
    public function submit(){
        
        //   $this->validate();
        
     Profit::create([   
        'user_id' => $this->user_id,
        'trader' => $this->trader,
        'platform' => $this->platform,
        'equity' => $this->equity,
        'description_in_transaction' => $this->description_in_transaction,
        'stake' => $this->stake,
        'net' => $this->net,
        'roiu' => $this->roiu,
        'add_deposit' => $this->add_deposit,

        ]);
        session()->flash('message', 'Data Updated Successfully.');
        
        
    }
    

    
    public function render()
    {
        return view('livewire.categories-create');
    }
}
