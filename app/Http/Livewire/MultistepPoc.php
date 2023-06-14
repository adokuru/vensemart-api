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

class MultistepPoc extends Component
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

   public $fileName;
   public $quantity;
   public  $shop_id;
   public  $status;
   public    $sub_cat_id;
   public   $uom_id;
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
    public $user_image;
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
    public $user;

                // ' => Hash::make('Candar')


    // protected $rules = [
    //     'btc_amount' => 'required|numeric',
    //     'usdt_amount' => 'required|numeric|gt:99'
    // ];

    public function mount(){
        // $this->user_id = auth()->user()->id;
        $this->currentStep = 1;
         
        //  auth()->user() = PocRegistration::find(auth()->user()->id)->first();
        $this->first_name =  auth()->user()->first_name;
        $this->last_name =  auth()->user()->last_name;
         $this->first_name =  auth()->user()->first_name;
        $this->last_name =  auth()->user()->last_name;
        $this->address =  auth()->user()->address;
        $this->city =  auth()->user()->city;
        $this->state =  auth()->user()->state;
        $this->country =  auth()->user()->country;
        $this->telephone =  auth()->user()->telephone;
        $this->email =  auth()->user()->email;
        $this->username =  auth()->user()->username;
        $this->ref_id =  auth()->user()->ref_id;
        $this->lendmark =  auth()->user()->lendmark;
        $this->zipcode =  auth()->user()->zipcode;
        $this->admin_status =  auth()->user()->admin_status;
        $this->user_status =  auth()->user()->user_status;
        $this->registration_date =  auth()->user()->registration_date;
        $this->image =  auth()->user()->image;
        $this->acc_name =  auth()->user()->acc_name;
        $this->ac_no =  auth()->user()->ac_no;
        $this->bank_nm =  auth()->user()->bank_nm;
        $this->branch_nm =  auth()->user()->branch_nm;
        $this->swift_code =  auth()->user()->swift_code;
        $this->last_login_date =  auth()->user()->last_login_date;
        $this->current_login_date =  auth()->user()->current_login_date;
        $this->id_card =  auth()->user()->id_card;
        $this->id_no =  auth()->user()->id_no;
        $this->kyc_status =  auth()->user()->kyc_status;
        $this->activation_date  =  auth()->user()->activation_date;
        $this->franchise_category =  auth()->user()->franchise_category;
        $this->franchise_satus=  auth()->user()->frachise_satus;
        $this->is_verified =  auth()->user()->is_verified;
        $this->gst =  auth()->user()->gst;
        $this->lati =  auth()->user()->lati;
        $this->longi =  auth()->user()->longi;
        $this->merried_status =  auth()->user()->merried_status;
        $this->gender =  auth()->user()->gender;
        $this->name = auth()->user()->name;
        $this->amount = 0;
        $this->crypto_amount = 0;
        $this->currency = 'btc';
        $this->amount = 0;
        // $this->todos = Products::all();
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

           $destinationPath = 'vendor_images'; 

           $extension = $this->fileName->getClientOriginalExtension(); 
   
           $fileName = rand(10000,200000000).$this->first_name. '.' . $extension;
   
           $this->image = $this->fileName->storeAs($destinationPath, $fileName,'public');

           $this->image = $fileName;
            //    dd($this->image);
    
             auth()->user()->update([
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'address' => $this->address,
                'city' => $this->city,
                'state' => $this->state,
                'country' => $this->country,
                'telephone' => $this->telephone,
                'email' => $this->email,
                'username' => $this->username,
                // 'user_id' => 1000,
                // 'ref_id' => 1000,
                'lendmark' => $this->lendmark,
                 'zipcode'  => $this->zipcode,
                 'admin_status'=> 1,
                 'user_status' => $this->user_status,
                 'registration_date'=> $this->registration_date,
                'image'=> $this->image,
                'acc_name'=> $this->acc_name,
                'ac_no'=> $this->ac_no,
                'bank_nm'=> $this->bank_nm,
                'branch_nm'=> $this->branch_nm,
                'swift_code'=> 'Abuja',
                'last_login_date'=> now(),
                'current_login_date'=> now(),
                'id_card'=> $this->id_card,
                'id_no'=> '0000',
                'kyc_status'=> 1,
                'activation_date'=> $this->activation_date,
                'franchise_category'=> $this->franchise_category,
                'franchise_satus'=> 1,
                'is_verified'=> 1,
                'gst'=> $this->gst,
                // 'lati'=> 'Abuja',
                // 'longi'=> 'Abuja',
                'merried_status'=> $this->merried_status,
                'gender'=> $this->gender,
                
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

            toastr()->success('Personal information has been updated successfully!');
           
            return redirect('/collectors');
          
           
  
           
  
        //    Mail::to(auth()->user()->email)->send(new Dep($validate))
         
          
            
          }


          }
         
          




    public function render()
    {
        return view('livewire.multistep-poc');
    }
}
