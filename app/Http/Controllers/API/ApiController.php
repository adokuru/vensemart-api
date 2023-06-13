<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;
use App\Mail\SendOrderMail;
use App\Models\Cart;
use App\Models\EshopPurchaseDetail;
use App\Traits\SendMessage;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller
{
    use sendMessage;
    //Notification List API

    public function test()
    {
        $name = "Rahul";

        $parts = explode(' ', $name);

        if (count($parts) > 2) {
            $first_name = $parts[0];
            $middle = $parts[1];
            $last_name = $parts[2];
        } else {
            $first_name = $parts[0];
            $middle = "";
            $last_name = $parts[1] ?? "";
        }

        return  response()->json([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'middle' => $middle,
        ]);
    }

    public function notification_list()
    {
        try {
            $user_id = Auth::id();
            // return $user_id;
            $notification = DB::table('notifications')->where('user_id', $user_id)->orderBy('id', 'desc')->get()->toArray();
            if ($notification) {
                $arr['status'] = 1;
                $arr['message'] = 'Success';
                $arr['data'] = $notification;
            } else {
                $arr['status'] = 0;
                $arr['message'] = 'No data';
                $arr['data'] = NULL;
            }
            return response()->json($arr, 200);
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = 'something went wrong';
            $arr['data'] = NULL;
        }

        return response()->json($arr, 200);
    }

    public function delete_user_notification(Request $request)
    {

        $user_id = Auth::id();


        $get_notification = DB::table('notifications')->where('user_id', $user_id)->delete();
        if ($get_notification) {
            $arr['status'] = 1;
            $arr['message'] = 'Success';
            $arr['data'] = null;
            return response()->json($arr, 200);
        } else {
            $arr['status'] = 0;
            $arr['message'] = 'notification not found';
            $arr['data'] = NULL;
            return response()->json($arr, 200);
        }
    }
    //Home API

    public function home(Request $request)
    {
        try {
            $banner_list =  DB::table('banners')->select('*', DB::raw('CONCAT("' . url('storage/banner_images') . '","/",banner_image)  as banner_image'))->where('status', '1')->orderBy('id', 'desc')->get()->toArray();
            $offer_list =   DB::table('offers')->select('*', DB::raw('CONCAT("' . url('storage/offer_images') . '","/",offer_banner)  as offer_banner'))->where('status', '1')->whereDate('end_date', '>=', Carbon::now())->orderBy('id', 'desc')->get()->toArray();
            $shop_list =    DB::table('stores')
                ->select(
                    "stores.*",
                    DB::raw('CONCAT("' . url('storage/shop_images') . '","/",store_image)  as store_image'),
                    DB::raw("6371 * acos(cos(radians(" . $request->lat . "))
                             * cos(radians(stores.lati)) 
                             * cos(radians(stores.longi) - radians(" . $request->lng . ")) 
                             + sin(radians(" . $request->lat . ")) 
                             * sin(radians(stores.lati))) AS distance")
                )
                ->having('distance', '<', '20')
                ->where('status', '1')->limit('4')->orderBy('id', 'desc')->get()->toArray();
            if ($shop_list) {
                $shop_ids = [];
                $tranding_product_id = [];
                foreach ($shop_list as $key => $val) {
                    $shop_ids[] = $val->id;
                }
                //  return $shop_ids;
                $tranding_product_list = DB::table('product_views')->select('product_id', DB::raw('count(*) as total'))->whereIn('shop_id', $shop_ids)->groupBy('product_id')->orderBy('total', 'desc')->get()->toArray();
                // if($tranding_product_list){
                foreach ($tranding_product_list as $key => $val) {
                    $tranding_product_id[] = $val->product_id;
                }
                $tranding_list = DB::table('products')->select('*', 'products.product_image as imagename', DB::raw('CONCAT("' . url('storage/product_images') . '","/",product_image)  as product_image'))->whereIn('id', $tranding_product_id)->limit('4')->orderBy('id', 'desc')->get()->toArray();
                // if($tranding_list==[]){

                //     $arr['status']=0;
                //     $arr['message']='Sorry, We don\'t deliver to this location yet. we are expanding stay with us!';
                //     $arr['data']=null;
                //     return response()->json($arr,200);   
                // }
                // }else{

                //     $arr['status']=0;
                //     $arr['message']='Sorry, We don\'t deliver to this location yet. we are expanding stay with us!';
                //     $arr['data']=null;
                //     return response()->json($arr,200);   
                // }
                $data['banner_list'] = $banner_list != [] ? $banner_list : [];
                $data['today_discount'] = $offer_list != [] ? $offer_list : [];
                $data['supermarket'] = $shop_list != [] ? $shop_list : [];
                $data['tranding_list'] = $tranding_list != [] ? $tranding_list : [];
                if ($data) {
                    $arr['status'] = 1;
                    $arr['message'] = 'Success';
                    $arr['data'] = $data;
                } else {
                    $arr['status'] = 0;
                    $arr['message'] = 'No data';
                    $arr['data'] = NULL;
                }
                return response()->json($arr, 200);
            } else {
                $arr['status'] = 0;
                $arr['message'] = 'Sorry, We don\'t deliver to this location yet. we are expanding stay with us!';
                $arr['data'] = null;
                return response()->json($arr, 200);
            }
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = 'something went wrong';
            $arr['data'] = NULL;
        }

        return response()->json($arr, 200);
    }
    //Search Product API

    public function search_product(Request $request)
    {
        try {
            $keyword = $request->keyword;
            // $shop_list =   DB::table('stores')
            //                 ->select("stores.*",DB::raw('CONCAT("' . url('storage/shop_images') . '","/",store_image)  as store_image'),
            //                 \DB::raw("6371 * acos(cos(radians(" . $request->lat . "))
            //                  * cos(radians(stores.lati)) 
            //                  * cos(radians(stores.longi) - radians(" . $request->lng . ")) 
            //                  + sin(radians(" .$request->lat. ")) 
            //                  * sin(radians(stores.lati))) AS distance"))
            //                  ->having('distance', '<', '20')
            //                 ->where('status','1')->orderBy('id','desc')->get()->toArray();


            $tranding_list = DB::table('products as p')->select('p.*', 'c.category_name', 's.store_name', 'u.name as uom_name', DB::raw('CONCAT("' . url('storage/product_images') . '","/",product_image)  as product_image'))
                ->join('category as c', 'c.id', 'p.category_id')
                ->join('stores as s', 's.id', 'p.shop_id')
                ->join('uom as u', 'u.id', 'p.uom_id')
                // ->whereIn('shop_id',$shop_ids)
                ->where(function ($query) use ($keyword) {
                    $query->where('c.category_name', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('p.product_title', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('p.product_description', 'LIKE', '%' . $keyword . '%');
                })
                ->orderBy('id', 'desc')
                ->get()->toArray();
            if ($tranding_list == []) {
                $arr['status'] = 0;
                $arr['message'] = 'Sorry, No data found!';
                $arr['data'] = null;
                return response()->json($arr, 200);
            } else {
                $arr['status'] = 1;
                $arr['message'] = 'Product Search successfully.';
                $arr['data'] = $tranding_list;
            }
            return response()->json($arr, 200);
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = 'Sorry!! Something Went Wrong';
            $arr['data'] = NULL;
        }

        return response()->json($arr, 200);
    }
    //Find Store near me API

    public function near_by_store_list(Request $request)
    {
        try {
            $shop_list =   DB::table('stores')
                ->select(
                    "stores.*",
                    DB::raw('CONCAT("' . url('storage/shop_images') . '","/",store_image)  as store_image'),
                    DB::raw("6371 * acos(cos(radians(" . $request->lat . "))
                             * cos(radians(stores.lati)) 
                             * cos(radians(stores.longi) - radians(" . $request->lng . ")) 
                             + sin(radians(" . $request->lat . ")) 
                             * sin(radians(stores.lati))) AS distance")
                )
                ->having('distance', '<', '20')
                ->where('status', '1')->orderBy('id', 'desc')->get()->toArray();
            if ($shop_list) {
                $arr['status'] = 1;
                $arr['message'] = 'Store found successfully.';
                $arr['data'] = $shop_list;
            } else {
                $arr['status'] = 0;
                $arr['message'] = 'Sorry!! Shop not found!';
                $arr['data'] = null;
            }
            return response()->json($arr, 200);
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = 'something went wrong';
            $arr['data'] = NULL;
        }

        return response()->json($arr, 200);
    }

    public function suggest_stores(Request $request)
    {
        try {
            $shop_list = DB::table('stores')
                ->select(
                    "stores.*",
                    DB::raw('CONCAT("' . url('storage/shop_images') . '","/",store_image)  as store_image')
                )
                ->where('status', '1')->orderBy('id', 'desc')->limit(10)->get()->toArray();
            if ($shop_list) {
                $shop_ids = [];
                foreach ($shop_list as $key => $val) {
                    $shop_ids[] = $val->id;
                }
                $tranding_shop_list = DB::table('product_views')->select('shop_id', DB::raw('count(*) as total'))->whereIn('shop_id', $shop_ids)->groupBy('shop_id')->orderBy('total', 'desc')->get()->toArray();
            }

            if ($tranding_shop_list) {
                $arr['status'] = 1;
                $arr['message'] = 'Store found successfully.';
                $arr['data'] = $shop_list;
            } else {
                $arr['status'] = 0;
                $arr['message'] = 'Sorry!! Shop not found!';
                $arr['data'] = null;
            }
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = 'something went wrong';
            $arr['data'] = NULL;
        }

        return response()->json($arr, 200);
    }
    //Search Product for Perticular Category API

    public function search_product_for_perticular_category(Request $request)
    {
        try {
            $category_id = $request->category_id;
            $product_list = DB::table('products as p')->select('p.*', 'c.category_name', 's.store_name', 'u.name as uom_name', DB::raw('CONCAT("' . url('storage/product_images') . '","/",product_image)  as product_image'))
                ->join('category as c', 'c.id', 'p.category_id')
                ->join('stores as s', 's.id', 'p.shop_id')
                ->join('uom as u', 'u.id', 'p.uom_id')
                ->where('category_id', $category_id)
                ->orderBy('id', 'desc')
                ->get()->toArray();
            if ($product_list == []) {
                $arr['status'] = 0;
                $arr['message'] = 'Sorry, No data found!';
                $arr['data'] = null;
                return response()->json($arr, 200);
            } else {
                $arr['status'] = 1;
                $arr['message'] = 'Product found successfully.';
                $arr['data'] = $product_list;
            }
            return response()->json($arr, 200);
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = 'something went wrong';
            $arr['data'] = NULL;
        }

        return response()->json($arr, 200);
    }
    //get product details
    public function get_product_details(Request $request)
    {
        try {
            $product_id = $request->product_id;
            $product_details = DB::table('products as p')->select('p.*', 'p.product_image as imagename',
             'c.category_name', 's.store_name', 'u.name as uom_name', 
            DB::raw('CONCAT("' . url('storage/product_images') . '","/",product_image)  as product_image'))
                ->join('category as c', 'c.id', 'p.category_id')
                ->join('stores as s', 's.id', 'p.shop_id')
                ->join('uom as u', 'u.id', 'p.uom_id')
                ->where('p.id', $product_id)
                ->first();
            if ($product_details == "") {
                $arr['status'] = 0;
                $arr['message'] = 'Sorry, No data found!';
                $arr['data'] = null;
                return response()->json($arr, 200);
            } else {

                $suggestion_product = DB::table('products as p')->select('p.*',
                 'p.product_image as imagename', 'c.category_name', 's.store_name', 
                 'u.name as uom_name', DB::raw('CONCAT("' . url('storage/product_images') . '","/",product_image)  as product_image'))
                    ->join('category as c', 'c.id', 'p.category_id')
                    ->join('stores as s', 's.id', 'p.shop_id')
                    ->join('uom as u', 'u.id', 'p.uom_id')
                    ->where('p.id', '!=', $product_id)
                    ->where('p.category_id', $product_details->category_id)
                    ->limit('10')
                    ->get()->toArray();

                // foreach($suggestion_product as $val)
                // {
                //     $val->imagename=$val->product_image;
                // }
                $data['suggestion_product'] = $suggestion_product != [] ? $suggestion_product : [];
                $data['product_details'] = $product_details;

                /** Addional code  27/09 for
                 ***  for add info in product_views
                 ***/
                $inst_data = array();
                $inst_data['shop_id'] =  $product_details->shop_id;
                $inst_data['product_id'] =  $product_details->id;
                $inst_data['status'] =  "1";
                DB::table("product_views")->insert($inst_data);
                $arr['status'] = 1;
                $arr['message'] = 'Product details found successfully.';
                $arr['data'] = $data;
            }
            return response()->json($arr, 200);
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = 'something went wrong';
            $arr['data'] = NULL;
        }

        return response()->json($arr, 200);
    }
    //category list api
    public function category_list()
    {
        try {
            $category_list = DB::table('category')->orderBy('id', 'DESC')->get()->toArray();

            if ($category_list == []) {

                $arr['status'] = 0;
                $arr['message'] = 'Sorry! no data found';
                $arr['data'] = NULL;
            } else {
                foreach ($category_list as $val) {
                    $val->category_icon = $val->category_icon ? url('storage/category_icons') . '/' . $val->category_icon : '';
                }
                $arr['status'] = 1;
                $arr['message'] = 'Category list found successfully.';
                $arr['data'] = $category_list;
            }
            return response()->json($arr, 200);
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = 'something went wrong';
            $arr['data'] = NULL;
        }

        return response()->json($arr, 200);
    }
    //sub category list api
    public function sub_category_list(Request $request)
    {
        $typevalidate = Validator::make($request->all(), ['sub_category_id' => 'required']);
        try {
            if ($typevalidate->fails()) {
                $arr['status'] = 0;
                $arr['message'] = "Validation Failed";
                $arr['data'] = NULL;

                return response()->json($arr, 200);
            }
            $sub_category_list = DB::table('sub_category')->where('cat_id', $request->sub_category_id)->orderBy('id', 'DESC')->get()->toArray();
            if ($sub_category_list == []) {
                $arr['status'] = 0;
                $arr['message'] = 'Sorry! no data found';
                $arr['data'] = NULL;
            } else {
                foreach ($sub_category_list as $val) {
                    $val->image = $val->image ? url('storage/subcategory_images') . '/' . $val->image : '';
                }
                $arr['status'] = 1;
                $arr['message'] = 'Sub Category list found successfully.';
                $arr['data'] = $sub_category_list;
            }
            return response()->json($arr, 200);
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = 'something went wrong';
            $arr['data'] = NULL;
        }

        return response()->json($arr, 200);
    }


    public function products_list(Request $request)
    {
        $typevalidate = Validator::make($request->all(), ['category_id' => 'required', 'sub_category_id' => 'required']);
        try {
            if ($typevalidate->fails()) {
                $arr['status'] = 0;
                $arr['message'] = "Validation Failed";
                $arr['data'] = NULL;

                return response()->json($arr, 200);
            }
            $products_list = DB::table('products')->where('category_id', $request->category_id)->where('sub_cat_id', $request->sub_category_id)->orderBy('id', 'DESC')->get()->toArray();
            if ($products_list == []) {
                $arr['status'] = 0;
                $arr['message'] = 'Sorry! no data found';
                $arr['data'] = NULL;
            } else {
                foreach ($products_list as $val) {
                    $val->imagename = $val->product_image;
                    $val->product_image = $val->product_image ? url('storage/product_images') . '/' . $val->product_image : '';
                }
                $arr['status'] = 1;
                $arr['message'] = 'Products List found successfully.';
                $arr['data'] = $products_list;
            }
            return response()->json($arr, 200);
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = 'Sorry!! Something Went Wrong';
            $arr['data'] = NULL;
        }

        return response()->json($arr, 200);
    }
    //add to cart api
    public function add_cart(Request $request)
    {
        $typevalidate = Validator::make($request->all(), [
            'product_id' => 'required',
            'cat_id' => 'required',
            'qty' => 'required',
            'discount' => 'required',
        ]);


        try {

            if ($typevalidate->fails()) {
                $arr['status'] = 0;
                $arr['message'] = $typevalidate->errors()->first();
                $arr['data'] = NULL;

                return response()->json($arr, 422);
            }


            $product = DB::table('products')->where('id', $request->product_id)->first();

            $price = ($product->product_price * $request->qty);

            $cartData = $request->all();

            $cartData['user_id'] = Auth::id();

            $cartData['after_discount_amount'] = (((100 - $request->discount) * $price) / 100);

            $cartData['product_name'] = $product->product_title;

            $cartData['product_image'] = $product->product_image;

            $cartData['net_amount'] = $price;

            unset($cartData['discount']);

            if ($request->qty == 0) {
                DB::table('cart')->where('user_id', Auth::id())->where('product_id', $request->product_id)->delete();
                $arr['status'] = 1;
                $arr['message'] = 'add cart successfully.';
                $arr['data'] = NULL;
                return response()->json($arr, 200);
            }

            $check_cart = Cart::where('user_id', Auth::id())->where('product_id', $request->product_id)->orderBy('id', 'desc')->first();

            if ($check_cart) {
                $qty = $check_cart->qty + $request->qty;
                $check_cart->qty =  $qty;
                $check_cart->net_amount = $check_cart->net_amount * $qty;
                $check_cart->save();
                $arr['status'] = 1;
                $arr['message'] = 'add cart successfully.';
                $arr['data'] = NULL;
                return response()->json($arr, 200);
            } else {

                $cart = DB::table('cart')->insert($cartData);
            }

            $arr['status'] = 1;
            $arr['message'] = 'add cart successfully.';
            $arr['data'] = NULL;
            return response()->json($arr, 200);
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = $e->getMessage();
            $arr['data'] = NULL;
            return response()->json($arr, 500);
        }
    }


    public function reduceQtyProductInCart(Request $request)
    {
        $typevalidate = Validator::make($request->all(), [
            'product_id' => 'required'
        ]);


        try {

            if ($typevalidate->fails()) {
                $arr['status'] = 0;
                $arr['message'] = $typevalidate->errors()->first();
                $arr['data'] = NULL;

                return response()->json($arr, 422);
            }

            $check_cart = Cart::where('user_id', Auth::id())->where('product_id', $request->product_id)->orderBy('id', 'desc')->first();
            $product = DB::table('products')->where('id', $request->product_id)->first();

            if (!$check_cart)
                throw new \Exception('Cart not found.');

            if (!$product)
                throw new \Exception('Product not found.');

            if ($check_cart->qty == 1) {
                $check_cart->delete();
            }

            $qty =  $check_cart->qty - 1;
            $check_cart->qty = $qty;
            $check_cart->net_amount = ($product->product_price * $qty);
            $check_cart->save();

            $check_cart->save();


            $arr['status'] = 1;
            $arr['message'] = 'Product reduced in cart successfully.';
            $arr['data'] = NULL;
            return response()->json($arr, 200);
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = $e->getMessage();
            $arr['data'] = NULL;
            return response()->json($arr, 500);
        }
    }

    public function addQtyProductInCart(Request $request)
    {
        $typevalidate = Validator::make($request->all(), [
            'product_id' => 'required'
        ]);


        try {

            if ($typevalidate->fails()) {
                $arr['status'] = 0;
                $arr['message'] = $typevalidate->errors()->first();
                $arr['data'] = NULL;

                return response()->json($arr, 422);
            }

            $check_cart = Cart::where('user_id', Auth::id())->where('product_id', $request->product_id)->orderBy('id', 'desc')->first();

            $product = DB::table('products')->where('id', $request->product_id)->first();


            if (!$check_cart)
                throw new \Exception('Cart not found.');

            if (!$product)
                throw new \Exception('Product not found.');

            $qty =  $check_cart->qty + 1;
            $check_cart->qty = $qty;
            $check_cart->net_amount = ($product->product_price * $qty);
            $check_cart->save();


            $arr['status'] = 1;
            $arr['message'] = 'Product qty increased in cart successfully.';
            $arr['data'] = NULL;
            return response()->json($arr, 200);
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = $e->getMessage();
            $arr['data'] = NULL;
            return response()->json($arr, 500);
        }
    }
    //Cart List API
    public function cart_list()
    {
        $user_id = Auth::id();
        try {
            $cart_list = DB::table('cart as c')->select('c.*', 's.id as shop_id', 
            'p.product_description', 'p.discount', 'cat.category_name', 's.store_name',
            'u.name as uom_name', DB::raw('CONCAT("' . url('storage/product_images') . '","/",c.product_image)  as product_image'), 'c.product_image as image_name')
                ->join('products as p', 'p.id', 'c.product_id')
                ->join('category as cat', 'cat.id', 'c.cat_id')
                ->join('stores as s', 's.id', 'p.shop_id')
                ->join('uom as u', 'u.id', 'c.uom_id')
                ->where('user_id', $user_id)
                ->orderBy('id', 'desc')
                ->get()->toArray();



            if ($cart_list == []) {
                $arr['status'] = 0;
                $arr['message'] = 'Cart is Empty';
                $arr['data'] = NULL;
            } else {
                $cart_details['subtotal'] = DB::table('cart')->where('user_id', $user_id)->sum('net_amount');
                $cart_details['delivery_charge'] = "500"; // TODO : Change it to dynamic
                $cart_details['grand_total'] = $cart_details['subtotal'] + $cart_details['delivery_charge'];

                $arr['status'] = 1;
                $arr['message'] = 'cart data found successfully.';
                $arr['data']['cart_list'] = $cart_list;
                $arr['data']['cart_details'] = $cart_details;
            }
            return response()->json($arr, 200);
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = 'Sorry!! Something Went Wrong';
            $arr['data'] = NULL;
        }
        return response()->json($arr, 200);
    }

    public function updateCart(Request $request)
    {
        $typevalidate = Validator::make($request->all(), [
            'product_id' => 'required',
            'qty' => 'required',
        ]);

        $user_id = Auth::id();

        $cart = DB::table('cart')->where('user_id', $user_id)->where('product_id', $request->product_id)->first();


        if ($cart) {
            $cart = DB::table('cart')->where('id', $cart->id)->first();
            $cart->qty = $request->qty;
            $cart->save();
            $arr['status'] = 1;
            $arr['message'] = 'Cart Updated Successfully';
            $arr['data'] = NULL;
            return response()->json($arr, 200);
        } else {
            $arr['status'] = 0;
            $arr['message'] = 'Cart Not Found';
            $arr['data'] = NULL;
            return response()->json($arr, 200);
        }
    }

    public function deleteCart(Request $request)
    {
        try {
            $typevalidate = Validator::make($request->all(), [
                'product_id' => 'required',
            ]);

            $user_id = Auth::id();

            $cart = DB::table('cart')->where('user_id', $user_id)->where('product_id', $request->product_id)->first();

            $cart = DB::table('cart')->where('id', $cart->id)->delete();

            $arr['status'] = 1;
            $arr['message'] = 'Cart Deleted Successfully';
            $arr['data'] = NULL;
            return response()->json($arr, 200);
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = 'Sorry!! Something Went Wrong';
            $arr['data'] = NULL;
        }
    }

    //place order api
    public function place_order(Request $request)
    {
        $typevalidate = Validator::make($request->all(), [
            'payment_type' => 'required',
            'delivery_charge' => 'required',
        ]);

        $user_id = Auth::id();
        $cart_detail = DB::table("cart")->where('user_id', $user_id)->get();

        try {
            if ($typevalidate->fails()) {
                $arr['status'] = 0;
                $arr['message'] = $typevalidate->errors()->first();
                $arr['data'] = NULL;
                return response()->json($arr, 500);
            }

            $cart_detail = DB::table("cart")->where('user_id', $user_id)->get();
            if (count($cart_detail) ==  0) {
                $arr['status'] = 0;
                $arr['message'] = 'cart is empty';
                $arr['data'] = null;
                return response()->json($arr, 200);
            }

            $invoice_no  =  rand(1000000000, 999999999999);



            $total_amount = 0;
            $net_amount = 0;

            foreach ($cart_detail as $key => $value) {
                $net_amount += $value->net_amount;
            }


            $taxes = $net_amount * 7.5 / 100;

            $total_amount = $net_amount + $request->delivery_charge + $taxes;

            $order_data['invoice_no'] = $invoice_no;
            $order_data['user_id'] = $user_id;
            $order_data['net_amount'] = $net_amount;
            $order_data['total_amount'] = $total_amount;
            $order_data['taxes'] =  $taxes;
            $order_data['delivery_charge'] = $request->delivery_charge;

            // if ($request->offer_id) {
            //     $order_data['offer_id'] = $request->offer_id;
            //     $order_data['offer_amount'] = $request->offer_amount;
            // }  // final amount 

            $order_data['payment_type'] = $request->payment_type;
            $order_data['total_item'] = count($cart_detail);
            $order_data['payment_status'] = 1;
            $order_data['status'] = 1;
            $order_data['purchase_date'] = date('Y-m-d');
            $order_data['order_id'] = "FM" . rand(10000, 99999);
            $order_data['transaction_id'] = rand(1000000000, 999999999999);

            DB::beginTransaction();

            $result1 = DB::table('orders')->insert($order_data);
            $store_id = 0;
            if ($result1) {
                $ins_data = array();
                foreach ($cart_detail as $k => $value) {
                    $ins_data[$k]['invoice_number'] = $invoice_no;
                    $ins_data[$k]['product_name'] = $value->product_name;

                    $ins_data[$k]['p_image'] = $value->product_image;
                    $ins_data[$k]['user_id'] = $value->user_id;
                    $ins_data[$k]['product_id'] = $value->product_id;
                    $store_id =  $this->getVendorId($value->product_id);
                    $ins_data[$k]['quantity'] = $value->qty;
                    $ins_data[$k]['net_price'] = $value->net_amount;
                    $ins_data[$k]['gst_percent'] = 0;
                    $ins_data[$k]['tax'] = 0;
                    $ins_data[$k]['basic_dp'] = $value->after_discount_amount;
                    $ins_data[$k]['dp'] = $value->after_discount_amount;
                    $ins_data[$k]['uom_id'] = $value->uom_id;
                    $ins_data[$k]['purchase_date'] = date('Y-m-d');
                    $ins_data[$k]['pay_mode']      = "CARD";

                    $ins_data[$k]['order_id'] = $order_data['order_id'];

                    $product_details = DB::table('products')->where('id', $value->product_id)->first();
                    if ($product_details) {

                        if ($product_details->quantity < $value->qty) {
                            DB::rollback();
                            $arr['status'] = 0;
                            $arr['message'] = 'Product ' . $product_details->product_name . ' qty is less then selected qty.';
                            $arr['data'] = NULL;
                            return response()->json($arr, 500);
                        }
                    }
                }

                // return $ins_data;
                $n_result = DB::table('eshop_purchase_detail')->insert($ins_data);


                $orderIdd = $order_data['order_id'];

                $data_noti = array('title' => "Order Placed", 'message' => "order placed successfully!  order  ID is  $orderIdd", 'user_id' => Auth::id());
                $this->sendNotification(Auth::id(), "Order Placed", "Order Placed Successfully ");
                
                $this->contactRiderAndVendor($orderIdd, $user_id);



                Log::info('product name ' . $value->product_name);
                Log::info('product name ' . $value->qty);
                Log::info('Store Id ' . $store_id);

                $vendor = $this->getVendor($store_id);


                Log::info('vendor phone ' . $vendor->telephone);
               

                 $phone_Number = '+234' . substr($vendor->telephone, -10);

                 $message = "Dear Vensemart Vendor, please prepare product for delivery ". " product name :" . $value->product_name . " quantity :" . $value->qty;

                 $this->sendSMSMessage($phone_Number, $message);


             

            

              
    
                DB::table('notifications')->insert(['user_id' => Auth::id(), 'title' => "Order Placed", 'message' => $data_noti['message'], 'type' => 1]);


                if ($n_result) {
                    DB::table('cart')->where('user_id', $user_id)->delete();
                    DB::commit();
                    $arr['status'] = 1;
                    $arr['message'] = 'order placed successfully';
                    $arr['data'] = ['order_id' => $invoice_no];
                    return response()->json($arr, 200);
                } else {
                    DB::rollback();
                    $arr['status'] = 0;
                    $arr['message'] = 'something went wrong';
                    return response()->json($arr, 200);
                }
            } else {
                DB::rollback();
                $arr['status'] = 0;
                $arr['message'] = 'something went wrong';
                return response()->json($arr, 200);
            }
        } catch (\Exception $e) {
            DB::rollback();
            $arr['status'] = 0;
            $arr['message'] = 'something went wrong';
            $arr['data'] = $e->getMessage();
            return response()->json($arr, 500);
        }
    }

    // public function place_order(Request $request)
    // {
    //     $typevalidate = Validator::make($request->all(), [
    //         'address_id' => 'required',
    //         'shop_id' => 'required',
    //         'net_amount' => 'required',
    //         'taxes' => 'required',
    //         'delivery_charge' => 'required',
    //         'total_amount' => 'required',
    //         'payment_type' => 'required',
    //     ]);

    //     // try{
    //     if ($typevalidate->fails()) {
    //         $arr['status'] = 0;
    //         $arr['message'] = $typevalidate->errors()->first();
    //         $arr['data'] = NULL;

    //         return response()->json($arr, 200);
    //     }

    //     $user_id22 = Auth::id();
    //     $userdata = DB::table('users')->where('id', $user_id22)->first();

    //     $cart_detail = DB::table("cart")->where('user_id', $user_id22)->get();
    //     if (count($cart_detail) ==  0) {
    //         $arr['status'] = 0;
    //         $arr['message'] = 'cart is empty';
    //         $arr['data'] = null;
    //         return response()->json($arr, 200);
    //     }

    //     $invoice_no  =  rand(1000000000, 999999999999);

    //     $order_data['invoice_no'] = $invoice_no;
    //     $order_data['user_id'] = $user_id22;
    //     $order_data['shop_id'] = $request->shop_id;
    //     $order_data['address_id'] = $request->address_id;
    //     $order_data['net_amount'] = $request->net_amount;
    //     $order_data['total_amount'] = ($request->net_amount);
    //     $order_data['taxes'] = $request->taxes;
    //     $order_data['delivery_charge'] = $request->delivery_charge;

    //     if ($request->offer_id) {
    //         $order_data['offer_id'] = $request->offer_id;
    //         $order_data['offer_amount'] = $request->offer_amount;
    //     }

    //     $order_data['total_amount'] = $request->total_amount;  // final amount 
    //     $order_data['payment_type'] = $request->payment_type;
    //     $order_data['total_item'] = count($cart_detail);
    //     $order_data['payment_status'] = $request->payment_status;
    //     $order_data['status'] = 1;
    //     $order_data['purchase_date'] = date('Y-m-d');
    //     $order_data['order_id'] = "FM" . rand(10000, 99999);
    //     $order_data['transaction_id'] = $request->transaction_id;

    //     DB::beginTransaction();

    //     //try{
    //     $result1 = DB::table('orders')->insert($order_data);


    //     if ($result1) {
    //         $ins_data = array();
    //         foreach ($cart_detail as $k => $value) {
    //             $ins_data[$k]['invoice_number'] = $invoice_no;
    //             $ins_data[$k]['product_name'] = $value->product_name;

    //             $ins_data[$k]['p_image'] = $value->product_image;
    //             $ins_data[$k]['user_id'] = $value->user_id;
    //             $ins_data[$k]['product_id'] = $value->product_id;

    //             $ins_data[$k]['quantity'] = $value->qty;
    //             $ins_data[$k]['net_price'] = $value->net_amount;
    //             $ins_data[$k]['gst_percent'] = 0;
    //             $ins_data[$k]['tax'] = 0;
    //             $ins_data[$k]['basic_dp'] = $value->after_discount_amount;
    //             $ins_data[$k]['dp'] = $value->after_discount_amount;
    //             $ins_data[$k]['uom_id'] = $value->uom_id;
    //             $ins_data[$k]['purchase_date'] = date('Y-m-d');
    //             $ins_data[$k]['pay_mode']      = "Cash On Franchise";

    //             $ins_data[$k]['order_id'] = $order_data['order_id'];

    //             $product_details = DB::table('products')->where('id', $value->product_id)->first();
    //             if ($product_details) {
    //                 if ($product_details->quantity < $value->qty) {
    //                     DB::rollback();
    //                     $arr['status'] = 0;
    //                     $arr['message'] = 'Product ' . $product_details->product_name . ' qty is less then selected qty.';
    //                     $arr['data'] = NULL;
    //                     return response()->json($arr, 200);
    //                 }
    //             }
    //         }

    //         // return $ins_data;
    //         $n_result = DB::table('eshop_purchase_detail')->insert($ins_data);

    //         $storedetails = DB::table('stores')->where('id', $request->shop_id)->first();

    //         $lat = $storedetails->lati;
    //         $lng = $storedetails->longi;

    //         $driver_list =    DB::table('users')
    //             ->select('users.*', DB::raw("6371 * acos(cos(radians(" . $lat . "))
    //                          * cos(radians(users.location_lat)) 
    //                          * cos(radians(users.location_long) - radians(" . $lng . ")) 
    //                          + sin(radians(" . $lat . ")) 
    //                          * sin(radians(users.location_lat))) AS distance"))
    //             ->having('distance', '<', 3)
    //             ->leftJoin('vehicle_details', 'vehicle_details.user_id', '=', 'users.id')
    //             ->where('vehicle_details.isVerify', '2')
    //             ->where('users.type', "2")
    //             ->orderBy('users.id', 'desc')
    //             ->first();

    //         $orderIdd = $order_data['order_id'];
    //         if ($driver_list) {
    //             DB::table('orders')->where('order_id', $order_data['order_id'])->update(['driver_id' => $driver_list->id]);


    //             $data_dtiver = array('title' => "new order received", 'message' => "$orderIdd new order received", 'user_id' => $driver_list->id);

    //             /************************Notification Start************/

    //             $firebaseToken =  DB::table('users')->where('id', $driver_list->id)->whereNotNull('device_token')->pluck('device_token')->toArray();

    //             $SERVER_API_KEY = env('FCM_KEY');

    //             $data1 = [
    //                 "registration_ids" => $firebaseToken,
    //                 "notification" => [
    //                     "title" => $data_dtiver['title'],
    //                     "body" => $data_dtiver['message'],
    //                 ]
    //             ];
    //             $dataString = json_encode($data1);

    //             $headers = [
    //                 'Authorization: key=' . $SERVER_API_KEY,
    //                 'Content-Type: application/json',
    //             ];

    //             $url = 'https://fcm.googleapis.com/fcm/send';
    //             $ch = curl_init();

    //             curl_setopt($ch, CURLOPT_URL, $url);
    //             curl_setopt($ch, CURLOPT_POST, true);
    //             curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    //             curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //             curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    //             curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    //             // Disabling SSL Certificate support temporarly
    //             curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //             curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
    //             // Execute post
    //             $result = curl_exec($ch);
    //             curl_close($ch);

    //             /*********************End Notification*****************/

    //             DB::table('notifications')->insert(['user_id' => $data_dtiver['user_id'], 'title' => $data_dtiver['title'], 'message' => $data_dtiver['message'], 'type' => 2]);
    //         }
    //         $data_noti = array('title' => "Order Placed", 'message' => "order placed successfully!  order  ID is  $orderIdd", 'user_id' => Auth::id());

    //         // DB::commit();

    //         // // $this->notification_send($data_dtiver);
    //         //  $this->notification_send($data_noti);
    //         // // add notification 

    //         /************************Notification Start************/


    //         /*********************End Notification*****************/



    //         DB::table('notifications')->insert(['user_id' => Auth::id(), 'title' => "Order Placed", 'message' => $data_noti['message'], 'type' => 1]);


    //         $get_user_data =  DB::table('users')->select('id', 'name', 'email')->where('id', Auth::id())->first();
    //         if ($get_user_data) {
    //             $data['name'] = $get_user_data->name;
    //             $data['msg'] = "Order  Placed: order placed successfully!  order  ID is  $orderIdd";
    //             $data['subject'] = "Order  Placed";
    //             \Mail::to($get_user_data->email)->send(new \App\Mail\SendOrderMail($data));
    //         }



    //         if ($n_result) {
    //             DB::table('cart')->where('user_id', $user_id22)->delete();
    //             DB::commit();
    //             $arr['status'] = 1;
    //             $arr['message'] = 'order placed successfully';
    //             $arr['data'] = ['order_id' => $invoice_no];
    //             return response()->json($arr, 200);
    //         } else {
    //             DB::rollback();
    //             $arr['status'] = 0;
    //             $arr['message'] = 'something went wrong';
    //             $arr['data'] = $e->getMessage();
    //             return response()->json($arr, 200);
    //         }
    //     } else {
    //         DB::rollback();
    //         $arr['status'] = 0;
    //         $arr['message'] = 'something went wrong';
    //         $arr['data'] = $e->getMessage();
    //         return response()->json($arr, 200);
    //     }

    //     return response()->json($arr, 200);
    // }
    //Search Product for Perticular Sub Category API



    public function getVendor($shopID)
    {
        try {
            $vendor = \App\Models\Stores::where('id', $shopID)->first();
            return $vendor;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function search_product_for_perticular_sub_category(Request $request)
    {
        try {
            $sub_category_id = $request->sub_category_id;
            $product_list = DB::table('products as p')->select('p.*', 'c.category_name', 'sc.name as sub_category_name', 's.store_name', 'u.name as uom_name', DB::raw('CONCAT("' . url('storage/product_images') . '","/",product_image)  as product_image'))
                ->join('category as c', 'c.id', 'p.category_id')
                ->join('sub_category as sc', 'sc.id', 'p.sub_cat_id')
                ->join('stores as s', 's.id', 'p.shop_id')
                ->join('uom as u', 'u.id', 'p.uom_id')
                ->where('p.sub_cat_id', $sub_category_id)
                ->orderBy('id', 'desc')
                ->get()->toArray();
            if ($product_list == []) {
                $arr['status'] = 0;
                $arr['message'] = 'Sorry, No data found!';
                $arr['data'] = null;
                return response()->json($arr, 200);
            } else {
                $arr['status'] = 1;
                $arr['message'] = 'Product found successfully.';
                $arr['data'] = $product_list;
            }
            return response()->json($arr, 200);
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = 'something went wrong';
            $arr['data'] = NULL;
        }

        return response()->json($arr, 200);
    }
    //offer list api
    public function offer_list()
    {
        try {
            $offer_list = DB::table('offers')->select('*', DB::raw('CONCAT("' . url('storage/offer_images') . '","/",offer_banner)  as offer_banner'))
                ->orderBy('id', 'desc')
                ->get()->toArray();
            if ($offer_list == []) {
                $arr['status'] = 0;
                $arr['message'] = 'Sorry, No data found!';
                $arr['data'] = null;
                return response()->json($arr, 200);
            } else {
                $arr['status'] = 1;
                $arr['message'] = 'Offer list found successfully.';
                $arr['data'] = $offer_list;
            }
            return response()->json($arr, 200);
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = 'something went wrong';
            $arr['data'] = NULL;
        }

        return response()->json($arr, 200);
    }

    public function coupon_list()
    {
        $user_id = Auth::id();
        try {
            $coupon_list = DB::table('coupons')->where('user_id', $user_id)->get()->toArray();
            foreach ($coupon_list as $value) {
                $value->discount = $value->discount . '%';
            }

            if ($coupon_list == []) {
                $arr['status'] = 0;
                $arr['message'] = 'No Coupons Found.';
                $arr['data'] = NULL;
            } else {
                $arr['status'] = 1;
                $arr['message'] = 'coupon data found successfully.';
                $arr['data']['coupon_list'] = $coupon_list;
            }
            return response()->json($arr, 200);
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = 'something went wrong';
            $arr['data'] = NULL;
        }
        return response()->json($arr, 200);
    }

    //Apply Coupon
    public function applycoupon(Request $request)
    {
        $typevalidate = Validator::make($request->all(), [
            'coupon_code' => 'required', 'sub_total' => 'required'
        ]);
        if ($typevalidate->fails()) {
            $arr['status'] = 0;
            $arr['message'] = "Validation Failed";
            $arr['data'] = NULL;
            return response()->json($arr, 200);
        }
        try {
            $user_id22 = Auth::id();
            //$userdata =DB::table('user_registration')->where('user_id',$user_id)->first();
            //$user_id22=$userdata->user_id;
            // $adminurl='http://182.76.237.238/~apitest/fresh_mor/cmsadmin/';

            $coupon_list = DB::table('coupons')->where('coupon_code', $request->coupon_code)->where('user_id', $user_id22)->where('status', 1)->first();
            if (!$coupon_list) {
                $arr['status'] = 0;
                $arr['message'] = "Coupons not found";
                $arr['data'] = NULL;
                return response()->json($arr, 200);
            }

            $cart_details['subtotal'] = $request->sub_total;
            $cart_details['subtotal_after_coupon']  =   ($request->sub_total - ($request->sub_total * $coupon_list->discount) / 100);

            $cart_details['delivery_charge'] = "20";
            $cart_details['grand_total'] =  $cart_details['subtotal_after_coupon'] + $cart_details['delivery_charge'];


            // $cart_details['shop_id'] = $getProductsDetail->shop_id;
            $cart_details['coupon_discount'] = $coupon_list->discount;
            $arr['status'] = 1;
            $arr['message'] = 'coupon applied!';
            $arr['data'] = $cart_details;

            return response()->json($arr, 200);
        } catch (\Exception $e) {

            $arr['status'] = 0;
            $arr['message'] = 'something went wrong..';
            $arr['data'] = NULL;
        }
        return response()->json($arr, 200);
    }
    //cancel reason question list api
    public function cancel_reason_question_list()
    {
        try {
            $cancel_reason_question_list = DB::table('cancel_reason')
                ->orderBy('name', 'asc')
                ->get()->toArray();
            if ($cancel_reason_question_list == []) {
                $arr['status'] = 0;
                $arr['message'] = 'Sorry, No data found!';
                $arr['data'] = null;
                return response()->json($arr, 200);
            } else {
                $arr['status'] = 1;
                $arr['message'] = 'Data found successfully.';
                $arr['data'] = $cancel_reason_question_list;
            }
            return response()->json($arr, 200);
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = 'something went wrong';
            $arr['data'] = NULL;
        }

        return response()->json($arr, 200);
    }
    //add delivery address api
    public function add_delivery_address(Request $request)
    {
        $typevalidate = Validator::make($request->all(), [
            'type' => 'required',
            'address' => 'required',
            'locality' => 'required',

            'city' => 'required',
            'state' => 'required'
        ]);
        try {
            if ($typevalidate->fails()) {
                $arr['status'] = 0;
                $arr['message'] = "Validation Failed";
                $arr['data'] = NULL;

                return response()->json($arr, 200);
            }
            $address = $request->all();
            $address['user_id'] = Auth::id();

            // $delivery_address = DB::table('user_address')->where('user_id',Auth::id())->where('type',$request->type)->first();
            // // print_r($delivery_address);die;
            // if($delivery_address){
            //     DB::table('user_address')->where('id',$delivery_address->id)->update($address);
            // }else{
            DB::table('user_address')->insert($address);
            // }
            $arr['status'] = 1;
            $arr['message'] = "address add successfully";
            $arr['data'] = NULL;
            return response()->json($arr, 200);
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = "something went wrong";
            $arr['data'] = NULL;
        }
        return response()->json($arr, 200);
    }
    //edit delivery address api
    public function edit_delivery_address(Request $request)
    {
        $typevalidate = Validator::make($request->all(), [
            'address' => 'required',
        ]);
        try {
            if ($typevalidate->fails()) {
                $arr['status'] = 0;
                $arr['message'] = "Validation Failed";
                $arr['data'] = NULL;

                return response()->json($arr, 200);
            }
            $address = $request->all();
            // unset($address['id']);
            DB::table('user_address')->where('id', $request->id)->update($address);
            $arr['status'] = 1;
            $arr['message'] = "address updated successfully";
            $arr['data'] = NULL;
            return response()->json($arr, 200);
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = "something went wrong";
            $arr['data'] = NULL;
        }
        return response()->json($arr, 200);
    }

    //delete delivery address api
    public function delete_delivery_address(Request $request)
    {
        $typevalidate = Validator::make($request->all(), ['id' => 'required']);
        try {
            if ($typevalidate->fails()) {
                $arr['status'] = 0;
                $arr['message'] = "Validation Failed";
                $arr['data'] = NULL;

                return response()->json($arr, 200);
            }
            $delivery_address = DB::table('user_address')->where('user_id', Auth::id())->where('id', $request->id)->delete();
            $arr['status'] = 1;
            $arr['message'] = "address delete successfully";
            $arr['data'] = NULL;
            return response()->json($arr, 200);
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = "something went wrong";
            $arr['data'] = NULL;
        }
        return response()->json($arr, 200);
    }
    //delivery address list api
    public function delivery_address_list(Request $request)
    {
        try {
            $user_id = Auth::id();
            $delivery_address = DB::table('user_address')->where('user_id', Auth::id())->get()->toArray();
            if ($delivery_address == []) {
                $arr['status'] = 0;
                $arr['message'] = "no address found";
                $arr['data'] = NULL;
            } else {
                $arr['status'] = 1;
                $arr['message'] = "address found successfully";
                $arr['data'] = $delivery_address;
            }
            return response()->json($arr, 200);
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = "something went wrong";
            $arr['data'] = NULL;
        }
        return response()->json($arr, 200);
    }

    public function shop($id)
    {

        $shop = DB::table('stores')->where('id', $id)->first();

        if (!$shop) {
            $arr['status'] = 0;
            $arr['message'] = "shop not found";
            $arr['data'] = NULL;
            return response()->json($arr, 200);
        }

        $shop->store_image = url('storage/shop_images') . '/' . $shop->store_image;


        $arr['status'] = 1;
        $arr['message'] = "shop found successfully";
        $arr['data'] = $shop;
        return response()->json($arr, 200);
    }

    //Search popular category and shops API
    public function popular_category_and_shop_list(Request $request)
    {
        try {
            $shop_list = DB::table('stores')
                ->select(
                    "stores.*",
                    DB::raw('CONCAT("' . url('storage/shop_images') . '","/",store_image)  as store_image'),
                    DB::raw("6371 * acos(cos(radians(" . $request->lat . "))
                             * cos(radians(stores.lati)) 
                             * cos(radians(stores.longi) - radians(" . $request->lng . ")) 
                             + sin(radians(" . $request->lat . ")) 
                             * sin(radians(stores.lati))) AS distance")
                )
                ->having('distance', '<', '20')
                ->where('status', '1')->orderBy('id', 'desc')->get()->toArray();
            if ($shop_list) {
                $shop_ids = [];
                $tranding_product_id = [];
                $tranding_cat_ids = [];
                $tranding_shop_id = [];
                foreach ($shop_list as $key => $val) {
                    $shop_ids[] = $val->id;
                }
                $tranding_product_list = DB::table('product_views')->select('product_id', DB::raw('count(*) as total'))->whereIn('shop_id', $shop_ids)->groupBy('product_id')->orderBy('total', 'desc')->get()->toArray();
                $tranding_shop_list = DB::table('product_views')->select('shop_id', DB::raw('count(*) as total'))->whereIn('shop_id', $shop_ids)->groupBy('shop_id')->orderBy('total', 'desc')->get()->toArray();
                if ($tranding_product_list) {
                    foreach ($tranding_product_list as $key => $val) {
                        $tranding_product_id[] = $val->product_id;
                    }
                    $tranding_cat_id = DB::table('products')->select('category_id', DB::raw('count(*) as total'))->whereIn('id', $tranding_product_id)->groupBy('category_id')->orderBy('total', 'desc')->get()->toArray();
                    if ($tranding_cat_id) {
                        foreach ($tranding_cat_id as $key => $val) {
                            $tranding_cat_ids[] = $val->category_id;
                        }
                        $tranding_cat_list = DB::table('category')->select('*', DB::raw('CONCAT("' . url('storage/category_icons') . '","/",category_icon)  as category_icon'))->whereIn('id', $tranding_cat_ids)->orderBy('id', 'desc')->get()->toArray();
                        if ($tranding_cat_list == []) {
                            $data['popular_category'] =  [];
                        } else {
                            $data['popular_category'] =  $tranding_cat_list;
                        }
                    } else {
                        $data['popular_category'] =  [];
                    }
                } else {
                    $data['popular_category'] =  [];
                }
                if ($tranding_shop_list) {
                    foreach ($tranding_shop_list as $key => $val) {
                        $tranding_shop_id[] = $val->shop_id;
                    }
                    $popular_shops = DB::table('stores')->select("stores.*", DB::raw('CONCAT("' . url('storage/shop_images') . '","/",store_image)  as store_image'))->whereIn('id', $tranding_shop_id)->orderBy('id', 'desc')->get()->toArray();
                    if ($popular_shops) {
                        $data['popular_shops'] =  $popular_shops;
                    } else {
                        $data['popular_shops'] =  [];
                    }
                } else {
                    $data['popular_shops'] =  [];
                }
            }
            if ($data == []) {
                $arr['status'] = 0;
                $arr['message'] = "no data found";
                $arr['data'] = NULL;
            } else {
                $arr['status'] = 1;
                $arr['message'] = "Data found successfully";
                $arr['data'] = $data;
            }
            return response()->json($arr, 200);
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = "something went wrong";
            $arr['data'] = NULL;
        }
        return response()->json($arr, 200);
    }
    //add product in favourite list
    public function add_favourite(Request $request)
    {
        $typevalidate = Validator::make($request->all(), [
            'product_id' => 'required',
            'status' => 'required',
        ]);
        try {
            if ($typevalidate->fails()) {
                $arr['status'] = 0;
                $arr['message'] = "Validation Failed";
                $arr['data'] = NULL;

                return response()->json($arr, 200);
            }
            if ($request->status == '1') {
                $favourite_data = DB::table('favourite_product')->where('user_id', Auth::id())->where('product_id', $request->product_id)->first();
                if (!$favourite_data) {
                    $data['user_id']    = Auth::id();
                    $data['product_id'] = $request->product_id;
                    $data['is_favourite'] = $request->status;
                    DB::table('favourite_product')->insert($data);
                }
            } else {
                DB::table('favourite_product')->where('user_id', Auth::id())->where('product_id', $request->product_id)->delete();
            }
            $arr['status'] = 1;
            $arr['message'] = "success";
            $arr['data'] = NULL;
            return response()->json($arr, 200);
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = "something went wrong";
            $arr['data'] = NULL;
        }
        return response()->json($arr, 200);
    }
    //Favourite List API
    public function favourite_list()
    {
        try {
            $user_id = Auth::id();
            $favourite_product = DB::table('favourite_product')
                ->select('favourite_product.is_favourite', 'p.*', 'c.category_name', 'sc.name as sub_category_name', 's.store_name', 'u.name as uom_name', DB::raw('CONCAT("' . url('storage/product_images') . '","/",product_image)  as product_image'))
                ->join('products as p', 'p.id', 'favourite_product.product_id')
                ->join('category as c', 'c.id', 'p.category_id')
                ->join('sub_category as sc', 'sc.id', 'p.sub_cat_id')
                ->join('stores as s', 's.id', 'p.shop_id')
                ->join('uom as u', 'u.id', 'p.uom_id')
                ->where('favourite_product.user_id', Auth::id())->get()->toArray();
            if ($favourite_product == []) {
                $arr['status'] = 0;
                $arr['message'] = "no data found";
                $arr['data'] = NULL;
            } else {
                $arr['status'] = 1;
                $arr['message'] = "data found successfully";
                $arr['data'] = $favourite_product;
            }
            return response()->json($arr, 200);
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = "something went wrong";
            $arr['data'] = NULL;
        }
        return response()->json($arr, 200);
    }
    //My orders API
    public function myOrders()
    {
        try {
            $orders = DB::table('orders as o')
                ->select('o.*', 'u.name', 'u.mobile', 'u.email', 'u.location', 'u.location_lat', 'u.location_long')
                ->join('users as u', 'u.id', 'o.user_id')
                ->where('o.user_id', Auth::id())->orderBy('o.id', 'desc')
                ->get();

            foreach ($orders as $key => $val) {
                $product_details =  EshopPurchaseDetail::where('order_id', $val->order_id)->get()->toArray();
                $val->products = $product_details != [] ? $product_details : [];
            }

            $order_list = $orders->toArray();
            if ($order_list == []) {
                $arr['status'] = 0;
                $arr['message'] = "no data found";
                $arr['data'] = NULL;
            } else {
                $arr['status'] = 1;
                $arr['message'] = "order list found successfully";
                $arr['data'] = $order_list;
            }
            return response()->json($arr, 200);
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = env('APP_DEBUG') ? $e->getMessage() : "something went wrong";
            $arr['data'] = NULL;
        }
        return response()->json($arr, 200);
    }

    public function Orders()
    {
        try {
            $orders = DB::table('orders as o')
                ->select('o.*', 's.store_name', 's.address as store_address', 'ua.type as address_type', 'ua.address as delivery_address', DB::raw('CONCAT("' . url('storage/shop_images') . '","/",s.store_image)  as store_image'))
                ->join('stores as s', 's.id', 'o.shop_id')
                ->join('user_address as ua', 'ua.id', 'o.address_id')
                ->where('o.user_id', Auth::id())->orderBy('o.id', 'desc')->get();

            foreach ($orders as $key => $val) {
                $product_details =  DB::table('orders_details as od')
                    ->select('p.*', 'c.category_name', 'sc.name as sub_category_name', 's.store_name', 'u.name as uom_name', DB::raw('CONCAT("' . url('storage/product_images') . '","/",product_image)  as product_image'))
                    ->join('products as p', 'p.id', 'od.product_id')
                    ->join('category as c', 'c.id', 'p.category_id')
                    ->join('sub_category as sc', 'sc.id', 'p.sub_cat_id')
                    ->join('stores as s', 's.id', 'p.shop_id')
                    ->join('uom as u', 'u.id', 'p.uom_id')
                    ->where('order_id', $val->id)
                    ->get()->toArray();
                $val->products = $product_details != [] ? $product_details : [];
            }
            $order_list = $orders->toArray();
            if ($order_list == []) {
                $arr['status'] = 0;
                $arr['message'] = "no data found";
                $arr['data'] = NULL;
            } else {
                $arr['status'] = 1;
                $arr['message'] = "order list found successfully";
                $arr['data'] = $order_list;
            }
            return response()->json($arr, 200);
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = "something went wrong";
            $arr['data'] = NULL;
        }
        return response()->json($arr, 200);
    }

    //Order details API
    public function order_details(Request $request)
    {
        $validate = Validator::make($request->all(), ['order_id' => 'required']);
        try {
            if ($validate->fails()) {
                $arr['status'] = 0;
                $arr['message'] = 'Validation Failed!!';
                $arr['data'] = NULL;
                return response()->json($arr, 200);
            }
            $orders = DB::table('orders as o')
                ->select('o.*', 's.store_name', 's.address as store_address', 'ua.type as address_type', 'ua.address as delivery_address', DB::raw('CONCAT("' . url('storage/shop_images') . '","/",s.store_image)  as store_image'))
                ->join('stores as s', 's.id', 'o.shop_id')
                ->join('user_address as ua', 'ua.id', 'o.address_id')
                ->where('o.user_id', Auth::id())
                ->where('o.id', $request->order_id)->first();

            if (!$orders) {
                $arr['status'] = 0;
                $arr['message'] = "no data found";
                $arr['data'] = NULL;
                return response()->json($arr, 200);
            }
            $product_details =  DB::table('orders_details as od')
                ->select('p.*', 'c.category_name', 'sc.name as sub_category_name', 's.store_name', 'u.name as uom_name', DB::raw('CONCAT("' . url('storage/product_images') . '","/",product_image)  as product_image'))
                ->join('products as p', 'p.id', 'od.product_id')
                ->join('category as c', 'c.id', 'p.category_id')
                ->join('sub_category as sc', 'sc.id', 'p.sub_cat_id')
                ->join('stores as s', 's.id', 'p.shop_id')
                ->join('uom as u', 'u.id', 'p.uom_id')
                ->where('order_id', $orders->id)
                ->get()->toArray();
            $orders->products = $product_details != [] ? $product_details : [];
            if (!$orders) {
                $arr['status'] = 0;
                $arr['message'] = "no data found";
                $arr['data'] = NULL;
            } else {
                $arr['status'] = 1;
                $arr['message'] = "order details found successfully";
                $arr['data'] = $orders;
            }
            return response()->json($arr, 200);
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = "something went wrong";
            $arr['data'] = NULL;
        }
        return response()->json($arr, 200);
    }
    //Cancel Order API
    public function cancel_order(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'order_id' => 'required',
            'status' => 'required',
            'cancel_reason' => 'required',
            'cancel_by' => 'required',
        ]);
        try {
            if ($validate->fails()) {
                $arr['status']  = 0;
                $arr['message'] = "Validation Failed";
                $arr['data']    = NULL;
                return response()->json($arr, 200);
            }
            DB::beginTransaction();
            try {
                $c_s['order_id'] = $request->order_id;
                $c_s['status'] = $request->status;
                $order_status = DB::table('orders_status')->where('order_id', $request->order_id)->where('status', $request->status)->first();
                if (!$order_status) {
                    DB::table('orders_status')->insert($c_s);
                }
                $c_s['cancel_reason'] = $request->cancel_reason;
                $c_s['cancel_by'] = $request->cancel_by;
                if ($request->other_reason) {
                    $c_s['other_reason'] = $request->other_reason;
                }
                unset($c_s['order_id']);
                DB::table('orders')->where('id', $request->order_id)->update($c_s);
                DB::commit();
                $arr['status'] = 1;
                $arr['message'] = "order cancel successfully";
                $arr['data'] = NULL;
                return response()->json($arr, 200);
            } catch (\Exception $e) {
                DB::rollback();
                $arr['status'] = 0;
                $arr['message'] = 'something went wrong';
                $arr['data'] = NULL;
                return response()->json($arr, 200);
            }
        } catch (\Exception $e) {
            $arr['status']  = 0;
            $arr['message'] = 'something went wrong';
            $arr['data']    = NULL;
            return response()->json($arr, 200);
        }
    }
    //Repeat Same Order API
    public function repeat_order(Request $request)
    {
        $typevalidate = Validator::make($request->all(), [
            'order_id' => 'required',
            'payment_type' => 'required',
            'payment_status' => 'required'
        ]);
        try {
            if ($typevalidate->fails()) {
                $arr['status'] = 0;
                $arr['message'] = "Validation Failed";
                $arr['data'] = NULL;
                return response()->json($arr, 200);
            }
            $user_id22 = Auth::id();


            $order_detail = DB::table("orders")->where('order_id', $request->order_id)->first();

            $invoice_no  =  rand(1000000000, 999999999999);

            $request_data = $request->all();

            $order_data['invoice_no'] = $invoice_no;
            $order_data['user_id'] = $user_id22;
            $order_data['shop_id'] = $order_detail->shop_id;
            $order_data['address_id'] = $order_detail->address_id;
            $order_data['net_amount'] = $order_detail->net_amount;
            $order_data['total_amount'] = ($order_detail->total_amount);
            $order_data['taxes'] = $order_detail->taxes;
            $order_data['delivery_charge'] = $order_detail->delivery_charge;
            if ($order_detail->offer_id) {
                $order_data['offer_id'] = $order_detail->offer_id;
                $order_data['offer_amount'] = $order_detail->offer_amount;
            }
            $order_data['total_amount'] = $order_detail->total_amount;  // final amount 
            $order_data['payment_type'] = $order_detail->payment_type;
            //$order_data['total_item'] = count($cart_detail);
            $order_data['payment_status'] = $request->payment_status;
            $order_data['status'] = 1;  // 
            $order_data['payment_status'] = 1;  // payment status
            $order_data['purchase_date'] = date('Y-m-d');
            $order_data['order_date'] = date('Y-m-d');

            $order_data['order_id'] = "FM" . rand(10000, 99999);


            $order_data['transaction_id'] = $request->transaction_id;

            // $order_data['deliver_date'] = date('Y-m-d', strtotime($day. ' + 4 days'));
            //   DB::table('amount_detail')->insert($order_data);

            DB::beginTransaction();
            // try{
            $result1 = DB::table('orders')->insert($order_data);


            if ($result1) {
                // get product detail 

                $o_detail  = DB::table('eshop_purchase_detail')->where('order_id', $request->order_id)->get();

                $ins_data = array();
                foreach ($o_detail as $k => $value) {
                    $ins_data[$k]['invoice_number'] = $invoice_no;
                    $ins_data[$k]['product_name'] = $value->product_name;

                    $ins_data[$k]['p_image'] = $value->p_image;
                    $ins_data[$k]['user_id'] = $value->user_id;
                    $ins_data[$k]['product_id'] = $value->product_id;

                    $ins_data[$k]['quantity'] = $value->quantity;
                    $ins_data[$k]['price'] =  $value->price;  // product price
                    $ins_data[$k]['net_price'] = $value->net_price;  // 
                    //   extra fiend
                    $ins_data[$k]['gst_percent'] = 0;
                    $ins_data[$k]['tax'] = 0;
                    //   $ins_data[$k]['tbv'] = 0;


                    // end
                    //   $ins_data[$k]['discount'] = $value->discount; 
                    $ins_data[$k]['basic_dp'] = $value->basic_dp;
                    //   $ins_data[$k]['dp'] = $value->dp;
                    $ins_data[$k]['uom_id'] = $value->uom_id;
                    $ins_data[$k]['purchase_date'] = date('Y-m-d');
                    $ins_data[$k]['pay_mode']      = "Cash On Franchise";

                    $product_details = DB::table('products')->where('id', $value->product_id)->first();
                    //  return $product_details;
                    if ($product_details) {
                        if ($product_details->quantity < $value->quantity) {
                            DB::rollback();
                            $arr['status'] = 0;
                            $arr['message'] = 'Product ' . $product_details->product_name . ' qty is less then selected qty.';
                            $arr['data'] = NULL;
                            return response()->json($arr, 200);
                        }
                    }
                }

                // return $ins_data;
                $n_result = DB::table('eshop_purchase_detail')->insert($ins_data);
                if ($n_result) {

                    DB::commit();
                    $arr['status'] = 1;
                    $arr['message'] = 'order placed successfully';
                    $arr['data'] = ['order_id' => $order_data['order_id']];
                    return response()->json($arr, 200);
                } else {
                    DB::rollback();
                    $arr['status'] = 0;
                    $arr['message'] = 'something went wrong';
                    $arr['data'] = null;
                    return response()->json($arr, 200);
                }
            } else {
                DB::rollback();
                $arr['status'] = 0;
                $arr['message'] = 'something went wrong';
                $arr['data'] = NULL;
                return response()->json($arr, 200);
            }
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = $e->getMessage();
            $arr['data'] = NULL;
        }
        return response()->json($arr, 200);
    }
    //Terms & Condition API


    public function return_order(Request $request)
    {
        $typevalidate = Validator::make($request->all(), [

            'order_id' => 'required',
            'refund_reson' => 'required',
        ]);
        try {
            if ($typevalidate->fails()) {
                $arr['status'] = 0;
                $arr['message'] = "Validation Failed";
                $arr['data'] = NULL;
                return response()->json($arr, 200);
            }
            $get_id = DB::table('orders')->where('order_id', $request->order_id)->first();
            $data['status'] = 6;
            $data['other_reason'] = $request->refund_reson;

            $data1['order_id'] = $get_id->id;
            $data1['status'] = 6;

            $refund_insert = DB::table('orders_status')->insert($data1);
            $update_refund = DB::table('orders')->where('order_id', $request->order_id)->update($data);


            if ($update_refund) {
                $arr['status'] = 1;
                $arr['message'] = "order refund success";
                $arr['data'] = null;
            } else {
                $arr['status'] = 0;
                $arr['message'] = "something went wrong ...";
                $arr['data'] = NULL;
            }
            return response()->json($arr, 200);
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = "something went wrong";
            $arr['data'] = NULL;
        }
        return response()->json($arr, 200);
    }



    public function terms_condition()
    {
        try {
            $terms_condition = DB::table('termsconditions')->first();
            if ($terms_condition) {
                $arr['status'] = 1;
                $arr['message'] = "success";
                $arr['data'] = $terms_condition;
            } else {
                $arr['status'] = 0;
                $arr['message'] = "no data";
                $arr['data'] = NULL;
            }
            return response()->json($arr, 200);
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = $e->getMessage();
            $arr['data'] = NULL;
        }
        return response()->json($arr, 200);
    }
    //About FreshMor API
    public function about_freshmor()
    {
        try {
            $about_freshmor = DB::table('about_freshmor')->first();
            if ($about_freshmor) {
                $arr['status'] = 1;
                $arr['message'] = "success";
                $arr['data'] = $about_freshmor;
            } else {
                $arr['status'] = 0;
                $arr['message'] = "no data";
                $arr['data'] = NULL;
            }
            return response()->json($arr, 200);
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = "something went wrong";
            $arr['data'] = NULL;
        }
        return response()->json($arr, 200);
    }
    //Send Query API
    public function send_query(Request $request)
    {
        $validate = Validator::make($request->all(), ['category' => 'required', 'message' => 'required']);
        try {
            if ($validate->fails()) {
                $arr['status']  = 0;
                $arr['message'] = "Validation Failed!!";
                $arr['data']    = NULL;
                return response()->json($arr, 200);
            }
            $query = $request->all();
            $query['user_id'] = Auth::id();
            DB::table('user_query')->insert($query);
            $arr['status'] = 1;
            $arr['message'] = "query send successfully";
            $arr['data'] = NULL;
            return response()->json($arr, 200);
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = "something went wrong";
            $arr['data'] = NULL;
        }
        return response()->json($arr, 200);
    }
    //Subscription plan list
    public function subscription_plan()
    {
        try {
            $subscription_plan = DB::table('subscriptions')->get()->toArray();
            if ($subscription_plan == []) {
                $arr['status'] = 0;
                $arr['message'] = "no data";
                $arr['data'] = NULL;
            } else {
                $arr['status'] = 1;
                $arr['message'] = "subscription plan list found successfully.";
                $arr['data'] = $subscription_plan;
            }
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = "something went wrong";
            $arr['data'] = NULL;
        }
        return response()->json($arr, 200);
    }
    //Send Feedback API
    public function send_feedback(Request $request)
    {
        $validate = Validator::make($request->all(), ['rating' => 'required', 'comments' => 'required', 'store_id' => 'required']);
        try {
            if ($validate->fails()) {
                $arr['status']  = 0;
                $arr['message'] = $validate->errors()->first();
                $arr['data']    = NULL;
                return response()->json($arr, 200);
            }
            $feedback = $request->all();
            $feedback['user_id'] = Auth::id();
            $feedback['date'] = date('d-m-Y');
            DB::table('user_feedback')->insert($feedback);
            $arr['status'] = 1;
            $arr['message'] = "feedback send successfully";
            $arr['data'] = NULL;
            return response()->json($arr, 200);
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = "something went wrong";
            $arr['data'] = NULL;
        }
        return response()->json($arr, 200);
    }
    //Change order status
    // public function accept_order(Request $request){
    //     $typevalidate=Validator::make($request->all(),[ 'order_id'=>'required',
    //                                                     'status'=>'required',
    //                                                     'expected_time'=>'required',
    //                                                   ]);
    //     try{
    //         if($typevalidate->fails())
    //         {
    //             $arr['status']=0;
    //             $arr['message']="Validation Failed";
    //             $arr['data']=NULL;

    //             return response()->json($arr,200);
    //         }
    //         DB::beginTransaction();
    //         try{
    //             $data['order_id'] = $request->order_id;
    //             $data['status'] = $request->status;
    //             $order_status = DB::table('orders_status')->where('order_id',$request->order_id)->where('status',$request->status)->first();
    //             if(!$order_status){
    //                 DB::table('orders_status')->insert($data);
    //             }
    //             $upd['status'] = $request->status;
    //             $upd['expected_time'] = $request->expected_time;
    //             DB::table('orders')->where('id',$request->order_id)->update($upd);
    //             //Send notification to user for accept order
    //             /* Now pending */

    //             //Send request to near by delivery boy
    //             /* Now pending */

    //             DB::commit();
    //             $arr['status']=1;
    //             $arr['message']="order accept successfully";
    //             $arr['data']=NULL;
    //         }catch(\Exception $e){
    //             DB::rollback();
    //             $arr['status']=0;
    //             $arr['message']='something went wrong';
    //             $arr['data']=NULL;
    //             return response()->json($arr,200);
    //         }
    //     }catch(\Exception $e){
    //         $arr['status']=0;
    //         $arr['message']="something went wrong";
    //         $arr['data']=NULL;
    //     }
    //     return response()->json($arr,200);
    // }
    public function addratings(Request $request)
    {
        $userId = Auth::id();
        try {
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = 'Sorry!! Something Went Wrong';
            $arr['data'] = NULL;
        }
        return response()->json($arr, 200);
    }

    public function product_details_orderid(Request $request)
    {
        $orderId = $request->order_id;
        try {
            $OrderDetails = DB::table('orders')->where('order_id', $orderId)->first();

            $data = DB::table('eshop_purchase_detail')->where('order_id', $OrderDetails->order_id)->get();
            //   print_r($data);die;
            if (!empty($OrderDetails)) {
                $driverinfo = DB::table('users')->where('id', $OrderDetails->driver_id)->where('type', '2')->first();

                if (!empty($driverinfo)) {
                    $OrderDetails->drivername = $driverinfo->name;
                    $OrderDetails->drivermobile = $driverinfo->mobile;
                    $OrderDetails->driverlat = $driverinfo->location_lat;
                    $OrderDetails->driverlong = $driverinfo->location_long;
                } else {
                    $OrderDetails->drivername = null;
                    $OrderDetails->drivermobile = null;
                    $OrderDetails->driverlat = null;
                    $OrderDetails->driverlong = null;
                }




                $OrderDetails->products = $data;

                foreach ($data as $val) {
                    $val->p_image = $val->p_image ? url('storage/product_images') . '/' . $val->p_image : '';
                }


                $arr['status'] = 1;
                $arr['message'] = 'Success';
                $arr['data'] = $OrderDetails;
            } else {
                $arr['status'] = 0;
                $arr['message'] = 'No Data found';
                $arr['data'] = NULL;
            }
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = $e->getMessage();
            $arr['data'] = NULL;
        }
        return response()->json($arr, 200);
    }

    public function suggested_products(Request $request)
    {
        $userId = Auth::id();
        $categoryId = $request->category_id;
        try {
            $suggestion_product = DB::table('products as p')->select('p.*', 'p.product_image as imagename', 'c.category_name', 's.store_name', 'u.name as uom_name', DB::raw('CONCAT("' . url('storage/product_images') . '","/",product_image)  as product_image'))
                ->join('category as c', 'c.id', 'p.category_id')
                ->join('stores as s', 's.id', 'p.shop_id')
                ->join('uom as u', 'u.id', 'p.uom_id')
                // ->where('p.id','!=',$product_id)
                ->where('p.category_id', $categoryId)
                ->limit('10')
                ->orderBy('p.id', 'desc')
                ->get()->toArray();


            if (!empty($suggestion_product[0])) {
                $arr['status'] = 1;
                $arr['message'] = 'Success';
                $arr['data'] = $suggestion_product;
            } else {
                $arr['status'] = 0;
                $arr['message'] = 'No Suggested Products Found';
                $arr['data'] = NULL;
            }
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = 'Sorry!! Something Went Wrong';
            $arr['data'] = NULL;
        }
        return response()->json($arr, 200);
    }

    public function return_order_list()
    {
        $user_id = Auth::id();

        // $user_id22=  Auth::user()->user_id;
        // $userdata=DB::table('user_registration')->where('id',$user_id)->first();
        // $user_id22 = $userdata->user_id;

        // $adminurl='http://182.76.237.238/~apitest/fresh_mor/cmsadmin/';
        try {
            // $orders = DB::table('amount_detail as o')
            //     ->select('o.*','pr.username as store_name','pr.address as store_address','ua.type as address_type','ua.address as delivery_address',
            //               DB::raw('CONCAT("' . url($adminurl.'warehouse_images') . '","/",pr.image)  as store_image'))
            //     ->where('o.user_id',$user_id22)
            //     ->where('o.order_status',"6")
            //     ->leftJoin('poc_registration as pr','pr.user_id','=','o.seller_id')
            //     ->leftJoin('user_address as ua','ua.id','o.address_id')
            //     ->get();

            $data = DB::table('orders')->where('user_id', $user_id)->where('status', '6')->get();
            if (!empty($data[0])) {
                foreach ($data as $val) {
                    $store = DB::table('stores')->where('id', $val->shop_id)->first();
                    $val->storename = $store->store_name;
                    $val->storeimage = $store->store_image ? url('storage/shop_images') . '/' . $store->store_image : '';
                }

                $arr['status'] = 1;
                $arr['message'] = 'Success';
                $arr['data'] = $data;
            } else {
                $arr['status'] = 0;
                $arr['message'] = 'No Data Found';
                $arr['data'] = NULL;
            }
            // foreach($orders as $key=>$val){
            //     $product_details =  DB::table('orders_details as od')
            //                         ->select('p.*','c.name','s.username as store_name','u.name as uom_name',
            //                         DB::raw('CONCAT("' . url($adminurl.'product_images') . '","/",p.image)  as product_image'))
            //                         ->join('eshop_products_main as p','p.product_id','od.product_id')
            //                         ->join('eshop_categories as c','c.category_id','p.category')
            //                       //  ->join('sub_category as sc','sc.id','p.sub_cat_id')
            //                         ->join('poc_registration as s','s.user_id','p.shop_id')
            //                         ->join('uom as u','u.id','p.uom_id')
            //                         ->where('order_id',$val->id)
            //                         ->get()->toArray();
            //     $val->products = $product_details!=[]?$product_details:[];
            // }
            // $order_list = $orders->toArray();


            // print_r($order_list);
            // die;
            // if($order_list==[]){
            //     $arr['status']=0;
            //     $arr['message']="no data found";
            //     $arr['data']=NULL;
            // }else{
            //     $arr['status']=1;
            //     $arr['message']="order list found successfully";
            //     $arr['data']=$order_list;
            // }
            return response()->json($arr, 200);
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = $e->getMessage();    //"something went wrong";
            $arr['data'] = NULL;
        }
        return response()->json($arr, 200);
    }

    public function offer_product_list()
    {
        $userId = Auth::id();
        try {
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = 'Sorry!! Something Went Wrong';
            $arr['data'] = NULL;
        }
        return response()->json($arr, 200);
    }

    public function addaddress_user(Request $request)
    {
        $userId = Auth::id();
        $userlat = $request->lat;
        $userlong = $request->long;
        $address = $request->address;
        $type = $request->type;
        try {
            $data = array('user_id' => $userId, 'type' => $type, 'address' => $address, 'user_lat' => $userlat, 'user_long' => $userlong);
            DB::table('add_address_user')->insert($data);

            $arr['status'] = 1;
            $arr['message'] = 'Success';
            $arr['data'] = true;
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = 'Sorry!! Something Went Wrong';
            $arr['data'] = NULL;
        }
        return response()->json($arr, 200);
    }

    public function addresss_user_list()
    {
        $userId = Auth::id();
        try {
            $data = DB::table('add_address_user')->where('user_id', $userId)->get();
            if (!empty($data[0])) {
                $arr['status'] = 1;
                $arr['message'] = 'Success';
                $arr['data'] = $data;
            } else {
                $arr['status'] = 0;
                $arr['message'] = 'No Data Found';
                $arr['data'] = NULL;
            }
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = 'Sorry!! Something Went Wrong';
            $arr['data'] = NULL;
        }
        return response()->json($arr, 200);
    }
    public function address_user_delete(Request $request)
    {
        $userId = Auth::id();
        $addressId = $request->addressid;
        try {
            DB::table('add_address_user')->where('id', $addressId)->delete();
            $arr['status'] = 1;
            $arr['message'] = 'Success';
            $arr['data'] = true;
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = 'Sorry!! Something Went Wrong';
            $arr['data'] = NULL;
        }
        return response()->json($arr, 200);
    }

    public function rateServiceProvider(Request $request)
    {
        $userId = Auth::id();

        try {
            $request->validate([
                'booking_id' => 'required',
                'rating' => 'required',
            ]);

            $booking_id = $request->booking_id;
            $rating = $request->rating;

            $booking = DB::table('servicebook_user')->where('id', $booking_id)->first();

            if ($booking) {
                $data = array('rating' => $rating);
                DB::table('servicebook_user')->where('id', $booking_id)->update($data);

                $arr['status'] = 1;
                $arr['message'] = 'Success';
                $arr['data'] = true;
            } else {
                $arr['status'] = 0;
                $arr['message'] = 'No Data Found';
                $arr['data'] = NULL;
            }
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = $e->getMessage();    //"something went wrong";
            $arr['data'] = NULL;
        }
        return response()->json($arr, 200);
    }
}