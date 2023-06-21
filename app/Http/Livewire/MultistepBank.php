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


class MultistepBank extends Component
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

        $this->acc_name =  auth()->user()->acc_name;
        $this->ac_no =  auth()->user()->ac_no;
        $this->bank_nm =  auth()->user()->bank_nm;
        $this->branch_nm =  auth()->user()->branch_nm;
        $this->swift_code =  auth()->user()->swift_code;
       
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

          if($this->currentStep == 2){


        auth()->user()->update([
            'acc_name'=> $this->acc_name,
            'ac_no'=> $this->ac_no,
            'bank_nm'=> $this->bank_nm,
            'branch_nm'=> $this->branch_nm,
            'swift_code'=> 'Abuja',
              
           ]);

           toastr()->success('Bank information has been updated successfully!');
       
           return redirect('/index');
        
            
          }


          }
         

    public function render()
    {
        return view('livewire.multistep-bank');
    }
}
