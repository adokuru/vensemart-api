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
use App\Models\SubCategory;
use Mail;
use Intervention\Image\Facades\Image;

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

    public $selectedState = null;
    public $subcategories;
    public $selectedCategory;
    public $selectedSubcategory;




    // protected $rules = [
    //     'btc_amount' => 'required|numeric',
    //     'usdt_amount' => 'required|numeric|gt:99'
    // ];


    protected $messages = [
        'fileName.required' => 'Please refresh page  and upload pick new image from gallery',
      
    ];

    public function mount(){
        $this->user_id = auth()->user()->id;
        
        
    }


    public function updatedCategoryId($value)
    {
        $this->subcategories = Subcategory::where('cat_id', $this->category_id)->get();
    }
    
    
     public function selectedPair($id){
    
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
                
              ]);
        }
        
        
    }

    public function register(){
          $this->resetErrorBag();
          if($this->currentStep == 4){
            
            
           

          

            
        $product = new Products();


        //normal image upload with laravel livewire
        // $destinationPath = 'product_images'; 

        // $extension = $this->fileName->getClientOriginalExtension(); 

        // $fileName = rand(1000,2000000).$this->product_title . '.' . $extension;


        // $this->product_image = $this->fileName->storeAs($destinationPath, $fileName,'public');

        // $this->product_image = $fileName;

        

       //normal image upload with intervention image

        $extension = $this->fileName->getClientOriginalExtension(); 
        $resizedImage = Image::make($this->fileName->getRealPath())
               ->resize(900, 500)
               ->encode();

        $fileNamee = rand(1000,200000000).$this->product_title . '.' . $extension;
        $fileName = $resizedImage->save(storage_path('/app/public/product_images/'.$fileNamee));
        $this->product_image = $fileNamee;
        
        
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
            
            return redirect('duppp');
          
           
  
           
  
        //    Mail::to(auth()->user()->email)->send(new Dep($validate))
         
          }
            
          }


    public function render()
    {
       
        $this->categories = Category::all();
        return view('livewire.multistep-product');
    }
}
