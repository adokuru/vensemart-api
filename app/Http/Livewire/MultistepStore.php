<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Deposit;
use App\Models\PocRegistration;
use App\Models\Stores;
use App\Models\Products;
use App\TodoInvestment;
use App\Mail\Deposit as Dep;
use Hash;
use Auth;

class MultistepStore extends Component
{


    use WithFileUploads;

    public $category_id;

   public $created_at;
   public $discount;
   public $in_stock;
   public $product_Description;
   public $product_image;
   public  $product_price;
   public $product_title;
   public $quantity;
   public  $shop_id;
   public  $status;
   public  $sub_cat_id;
   public  $uom_id;
   public  $updated_at;
    public $user_id;
    public $todo_id;
    public $start_time;
    public $end_time;
    public $amount;
    public $currency;
    public $crypto_amount;
    public $terms;
    public $todos;
     public $filename;
    public $us_balance,$todo;
    public $totalSteps = 4;
    public $currentStep = 1;
    public $name;
    public $first_name;
    public $last_name;
    public $address;
    public $city;
    public $state;
    public $country;
    public $telephone;
    public $email;
    public $username;
    public $ref_id;
    public $lendmark;
    public $zipcode;
    public $admin_status;
    public $user_status;
    public $registration_date;
    public $image;
    public $acc_name;
    public $ac_no;
    public $bank_nm;
    public $branch_nm;
    public $swift_code;
    public $last_login_date;
    public $current_login_date;
    public $id_card;
    public $id_no;
    public $kyc_status;
    public $activation_date;
    public $franchise_category;
    public $franchise_satus;
    public $is_verified;
    public $gst;
    public $lati;
    public $longi;
    public $merried_status;
    public $gender;
    public $password;
    public $franchise_id;
    public $store_image;
    public $store_name;
    public $fileName;

                // ' => Hash::make('Candar')


    // protected $rules = [
    //     'btc_amount' => 'required|numeric',
    //     'usdt_amount' => 'required|numeric|gt:99'
    // ];

    public function mount(){
        // $this->user_id = auth()->user()->id;
        $this->currentStep = 1;


        $store =  Stores::where('franchise_id', auth()->user()->user_id)->first();
        $this->store_name = $store->store_name;
        $this->store_image = $store->store_image;
        $this->address = $store->address;
        $this->name = auth()->user()->name;
        $this->first_name =  auth()->user()->first_name;
        $this->last_name =  auth()->user()->last_name;
        $this->amount = 0;
        $this->crypto_amount = 0;
        $this->currency = 'btc';
        $this->amount = 0;
        $this->todos = Products::all();
    }
    
    
    
     public function selectedPair($id){
        $todo = Products::find($id);
        $this->todo = $todo;
        $this->todo_id = $todo->fileTitle;
         $this->filename = $todo->fileName;
        $this->increaseStep();
    }



    public function increaseStep(){
        $this->resetErrorBag();
        $this->validateData();
         $this->currentStep++;
         if($this->currentStep > $this->totalSteps){
             $this->currentStep = $this->totalSteps;
         }
    }

    public function decreaseStep(){
        $this->resetErrorBag();
        $this->currentStep--;
        if($this->currentStep < 1){
            $this->currentStep = 1;
        }
    }

    public function validateData(){

        if($this->currentStep == 1){
            // $this->validate([
            //     'payment'=>'required|string',
               
            // ]);
        }
        elseif($this->currentStep == 2){
            //   $this->validate([
            //      'payment'=>'required|numeric',
            //     //  'crypto_amount'=>'required|numeric',
            //   ]);
        }
        
    }

    // public function UpdatingStoreImage(){

    //     $store =  Stores::where('franchise_id', auth()->user()->user_id)->first();

    //     $destinationPath = 'public/todos'; 

    //  $extension = $this->fileName->getClientOriginalExtension(); 

    //    $fileName = $this->store_name . '.' . $extension;

    //    $this->store_image = $this->fileName->storeAs($destinationPath, $fileName,'public');
    // }

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
        //    $poc = PocRegistration::find(auth()->user()->id)->first();

        $store =  Stores::where('franchise_id', auth()->user()->user_id)->first();

        $destinationPath = 'shop_images'; 

        $extension = $this->fileName->getClientOriginalExtension(); 


        if($extension !== null){



          

        // $destinationPath = 'shop_images'; 

        // $extension = $this->fileName->getClientOriginalExtension(); 

        $fileName = rand(1000,500000).$this->store_name . '.' . $extension;
        

        $this->store_image = $this->fileName->storeAs($destinationPath, $fileName,'public');
            
        $this->store_image = $fileName;

           $store->update([
              'address' => $this->address, 
            //   'lati'=> 'Abuja', 
            //    'longi'=> 'Abuja', 
              'status' => 2,
              'store_image' => $this->store_image,
              'store_name' => $this->store_name, 
                
             ]);

             
             toastr()->success('Store information has been updated successfully!');
       
             return redirect('/collectors');
          



        }else{

            $store->update([
                'address' => $this->address, 
              //   'lati'=> 'Abuja', 
              //    'longi'=> 'Abuja', 
                // 'status' => 2,
                // 'store_image' => $this->store_image,
                'store_name' => $this->store_name, 
                  
               ]);

            toastr()->success('Store information has been updated successfully!');
       
             return redirect('/collectors');





        }

           
    
            
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
           
          
           
  
           
  
        //    Mail::to(auth()->user()->email)->send(new Dep($validate))
         
          
            
          }


          }
         
          



    public function render()
    {
        return view('livewire.multistep-store');
    }
}
