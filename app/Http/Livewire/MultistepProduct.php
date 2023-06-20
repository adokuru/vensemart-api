<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Deposit;
use App\Models\Products;
use App\Models\Stores;
use App\Models\Category;
use App\TodoInvestment;
use App\Mail\Deposit as Dep;
use Mail;

class MultistepProduct extends Component
{


    use WithFileUploads;

    public $category_id;

   public $created_at;
   public $discount;
   public $fileName;
   public $categories;
   public $in_stock;
   public $product_Description;
   public $product_image;
   public  $product_price;
   public $product_title;
   public  $product_weight;
   public $quantity;
   public  $shop_id;
   public  $status;
   public  $sub_cat_id;
   public   $uom_id;
   public  $updated_at;
   public  $category_name;
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


    // protected $rules = [
    //     'btc_amount' => 'required|numeric',
    //     'usdt_amount' => 'required|numeric|gt:99'
    // ];

    public function mount(){
        $this->user_id = auth()->user()->id;
        $this->currentStep = 1;
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
              $this->validate([
                 'product_title'=>'required',
                 'product_price'=>'required|numeric',
                 'discount'=>'required|numeric',
                 'product_Description'=>'required',
              ]);
        }

        elseif($this->currentStep == 3){
              $this->validate([
                 'quantity'=>'required|numeric',
                 'product_weight'=>'required|numeric',
                 'fileName' => 'required',
                //  'crypto_amount'=>'required|numeric',
              ]);
        }
        
        
    }

    public function register(){
          $this->resetErrorBag();
          if($this->currentStep == 4){
            //   $this->validate([
            //       'cv'=>'required|mimes:doc,docx,pdf|max:1024',
            //       'terms'=>'accepted'
            //   ])

            // $this->user_id = auth()->user()->id;


            // $store =  Stores::where('franchise_id', auth()->user()->user_id)->first();
            
            $this->todos = Products::all();

          

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

            

            $product = new Products();



        $destinationPath = 'product_images'; 

        $extension = $this->fileName->getClientOriginalExtension(); 

        $fileName = rand(1000,2000000).$this->product_title . '.' . $extension;


        $this->product_image = $this->fileName->storeAs($destinationPath, $fileName,'public');

        $this->product_image = $fileName;
        
        // $filename = $this->image->store('images', 'public');
       
         
        // 'id' => 'int', 'category_id' => 'int',
        //  'created_at' => 'timestamp', 'discount' => 'string',
        //  'product_Description' => 'string', 'product_image' => 'string', 
        //  'product_price' => 'float', 'product_title' => 'string', 'quantity' => 'int',
        //  'shop_id' => 'int', 'sub_cat_id' => 'int', 'uom_id' => 'int', 'updated_at' => 'datetime'


        $store = Stores::where('franchise_id', auth()->user()->user_id)->first();
        $storeId =  $store->id;

            $product->create([

                'category_id'  =>  $this->category_id, 
                'discount'  =>    $this->discount, 
                 'in_stock'  =>  1,
                 'product_Description' =>  $this->product_Description,
                 'product_image' =>  $this->product_image, 
                 'product_price' =>  $this->product_price, 
                  'product_title' => $this->product_title, 
                  'quantity' =>  $this->quantity, 
                  'shop_id' =>  $storeId,
                   'status' =>  1, 
                   'sub_cat_id' =>  1, 
                   'uom_id' =>  1, 

            ]);

           


            


            // $validate = $this->validate([
            //  'category_id'  =>  'required', 
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
              
            //     ]);


       
            // Products::create($validate);

            toastr()->success('Product has been created successfully!');
            session()->flash('message', 'product created successfully successfully.');
            
            return redirect('collectors');
          
           
  
           
  
        //    Mail::to(auth()->user()->email)->send(new Dep($validate))
         
          }
            
          }


    public function render()
    {
        $this->todos = Products::all();
        $this->categories = Category::all();
        return view('livewire.multistep-product');
    }
}
