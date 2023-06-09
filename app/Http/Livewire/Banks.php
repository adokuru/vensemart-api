<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Todo;
use App\Models\TodoInvestment;
use App\Models\Plantoken;


class Banks extends Component
{
    use WithFileUploads;
    public $acc_name;
    public $ac_no;
    public $bank_nm;
    public $branch_nm;
    public $swift_code;
    public $data_id,$fileTitle, $fileName,$price,$result_date,$uploads, $minings,
    $earning_date,$option_type,$Volume,$Avg_volume,$market_cap,$minimum_investment,$deposit_amount,$minimum_deposit,$number_of_investors,$avg_profit_24;
  
    /**
     * Write code on Method
     *
     * @return response()
     */


     public function mount(){

        $this->acc_name =  auth()->user()->acc_name;
        $this->ac_no =  auth()->user()->ac_no;
        $this->bank_nm =  auth()->user()->bank_nm;
        $this->branch_nm =  auth()->user()->branch_nm;
        $this->swift_code =  auth()->user()->swift_code;
     }
     
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


    public function register(){
        $this->resetErrorBag();
        if($this->currentStep == 4){

          // session()->flash('message', 'logged in successfully.');
          //   $this->validate([
          //       'cv'=>'required|mimes:doc,docx,pdf|max:1024',
          //       'terms'=>'accepted'
          //   ])

          // $this->user_id = auth()->user()->id;
          // $this->todos = Products::all();

          // 'category_id', 
          // 'created_at', 
          // 'discount', 
          // 'in_stock',
          //  'product_Description',
          //   'product_image', 
          //   'product_price', 
          //   'product_title', 
          //   'quantity', 
          //   'shop_id',
          //    'status', 
          //    'sub_cat_id', 
          //    'uom_id', 
          //    'updated_at'
          

          // Stores::create([
          //     'address' => 'Abuja', 
          //     'franchise_id'=> 'Abuja',
          //     'lati'=> 'Abuja', 
          //     'longi'=> 'Abuja', 
          //     'status' => '1',
          //      'store_image' => 'Abuja',
          //      'store_name' => 'Abuja', 
          // ]);
         $poc = PocRegistration::find(auth()->user()->id)->first();
  
           $poc->update([
           
              'acc_name'=> 'Abuja',
              'ac_no'=> 'Abuja',
              'bank_nm'=> 'Abuja',
              'branch_nm'=> 'Abuja',
              'swift_code'=> 'Abuja',
             
          ]);

          
          
  
          
          // $validate = $this->validate([
          // 'category_id'  =>  'required', 
          //  'created_at'  =>  'required', 
          // 'discount'  =>  'required', 
          //  'in_stock'  =>  'required',
          //  'product_Description' =>  'required',
          //  'product_image' =>  'required', 
          //  'product_price' =>  'required', 
          //   'product_title' =>  'required', 
          //   'quantity' =>  'required', 
          //   'shop_id' =>  'required',
          //    'status' =>  'required', 
          //    'sub_cat_id' =>  'required', 
          //    'uom_id' =>  'required', 
          //    'updated_at' =>  'required'
          //     ]);


     
          // Products::create($validate);
         
          return redirect('/collectors');
        
         

         

      //    Mail::to(auth()->user()->email)->send(new Dep($validate))
       
        
          
        }


        }
       
        



    public function render()
    {

        $poc = PocRegistration::find(auth()->user()->id)->first();
        $this->minings = $poc;
        return view('livewire.banks');
    }
}
