<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public function products($category_id)
    {
        $userId = Auth::id();
        $categoryId = $category_id;
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



    public function featured_items()
    {
        $userId = Auth::id();
        $categoryId = $category_id;
        try {
            $suggestion_product = DB::table('products as p')->select('p.*', 'p.product_image as imagename', 'c.category_name', 's.store_name', 'u.name as uom_name', DB::raw('CONCAT("' . url('storage/product_images') . '","/",product_image)  as product_image'))
                // ->join('category as c', 'c.id', 'p.category_id')
                ->join('stores as s', 's.id', 'p.shop_id')
                // ->join('uom as u', 'u.id', 'p.uom_id')
                // ->where('p.id','!=',$product_id)
                // ->where('p.category_id', $categoryId)
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

    public function product_details($id)
    {
        $userId = Auth::id();
        $product_id = $id;
        try {
            $suggestion_product = DB::table('products as p')->select('p.*', 'p.product_image as imagename', 's.store_name', 'u.name as uom_name', DB::raw('CONCAT("' . url('storage/product_images') . '","/",product_image)  as product_image'))
                ->join('stores as s', 's.id', 'p.shop_id')
                ->join('uom as u', 'u.id', 'p.uom_id')
                ->where('p.id', '=', $product_id)
                ->first();

            if (!empty($suggestion_product)) {
                $arr['status'] = 1;
                $arr['message'] = 'Success';
                $arr['data'] = $suggestion_product;
            } else {
                $arr['status'] = 0;
                $arr['message'] = 'No Suggested Products Found';
                $arr['data'] = NULL;
            }
            return response()->json($arr, 200);
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = env('APP_DEBUG') ? $e->getMessage() : 'Sorry!! Something Went Wrong';
            $arr['data'] = NULL;
            return response()->json($arr, 500);
        }
    }
}
