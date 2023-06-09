<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Livewire\WithFileUploads;


class ProductForm extends Component
{
    
    use WithFileUploads;
public $productTitle;
public $productImage;



    public function sendImageAndTitle($imageName, $productTitle)
    {
        $dd($url);
        $url = 'https://api.vensemart.com/api/product_image';
    
        $response = Http::attach(
            'product_image',
            file_get_contents($imageName),
            function ($name) use ($imageName) {
                return $name;
            }
        )->post($url, [
            'product_title' => $productTitle,
        ]);
    
        return $response;
    }


public function submitForm(Request $request)
{

    
    $request = $this->validate([
        'productTitle' => 'required',
        'productImage' => 'required|image',
    ]);

    

    $imageName = time() . '.' . $this->productImage->extension();
    $request->productImage->storeAs('public/temp_images', $imageName);

    // Send the image and product title to the remote API
    $response = $this->sendImgeAndTitle($imageName, $request->productTitle);

    // Handle the response from the remote API
    // ...

    // $response = $this->sendImageAndTitle($imageName, $request->productTitle);
dd($response);
    if ($response->successful()) {
        return redirect('/success-page');
    } else {
        return redirect('/error-page');
    }
}

    public function render()
    {
        return view('livewire.product-form');
    }
}
