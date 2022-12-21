<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Exception;

class ProductController extends Controller
{
    /**
    *Listing of products
    */
    public function getAllProducts(){
        try{
            $products = Product::latest()->get();
            
            return response()->json([
                'data' => $products->toArray(),
                'statusCode' => 1
            ]);

        }catch (\Exception $e) {
           return response([
                'message' => 'Invalid Request',
                'statusCode' => 0]
            );
        }
    }

    /*
    * Add product blade
    */
    public function addProduct(Request $request){
        try{
            $validator = $request->validate([
                'name' => 'required|max:255',
                'detail' => 'required',
                'created_at' => 'date',
            ]);

            $storeData = Product::create($validator);

            if($storeData){
                return response()->json([
                    'data' => $storeData->id,
                    'message' => 'Product Created Successfully.',
                    'statusCode' => 1,
                ]);
            }
        }catch (\Exception $e) {
            return response([
                'message' => 'Invalid Request',
                'statusCode' => 0]
            );
        }
    }

    /**
    *View single product
    */
    public function viewSingleProduct(Request $request){
        try{
            $validator = $request->validate([
                'id' => 'required',
            ]);

            $singleProduct = Product::where('id', $request->id)->first();
            
            if (!empty($singleProduct)) {

                return response()->json([
                    'data' => $singleProduct->toArray(),
                    'message' => '',
                    'statusCode' => 1,
                ]);
            }else{
                return response()->json([
                    'data' => "",
                    'message' => 'No Product Found',
                    'statusCode' => 1,
                ]);
            }

        }catch (\Exception $e) {
            return response([
                'message' => 'Invalid Request',
                'statusCode' => 0]
            );
        }
    }

    /**
    *View Update Product
    */
    public function updateProduct(Request $request){
        try{
            $request->validate([
                'id' => 'required',
                'name' => 'required|max:255',
                'detail' => 'required',
                'updated_at' => 'date',
            ]);

            $singleProduct = Product::where('id', $request->id)->first();
            $updateData = $singleProduct->update($request->all());
           
            if ($updateData) {
                return response()->json([
                    'data' => "",
                    'message' => 'Product Updated Successfully.',
                    'statusCode' => 1,
                ]);
            }
        }catch (\Exception $e) {
            return response([
                'message' => 'Invalid Request',
                'statusCode' => 0]
            );
        }
    }

    /*
    * Delete product details
    */
    public function deleteProduct(Request $request){
        try{
            $request->validate([
                'id' => 'required',
            ]);
            $singleProduct = Product::where('id', $request->id)->first();
            if($singleProduct){
                $singleProduct->delete();
            }else{
                return response()->json([
                    'data' => "",
                    'message' => 'No Product Found.',
                    'statusCode' => 1,
                ]);
            }

            if ($singleProduct) {
                return response()->json([
                    'data' => "",
                    'message' => 'Product Deleted Successfully.',
                    'statusCode' => 1,
                ]);
            }
        }catch(\Exception $e){
            return response([
                'message' => 'Invalid Request',
                'statusCode' => 0]
            );
        }
    }

    /*
    * Search product 
    */
    public function searchProduct(Request $request){
        try{
            $searchTerm = $request->search;
            $products = Product::where('name', 'like', '%' . $searchTerm . '%')
                ->get();

            return response()->json([
                'data' => $products->toArray(),
                'statusCode' => 1
            ]);

        }catch(\Exception $e){
            return response([
                'message' => 'Invalid Request',
                'statusCode' => 0]
            );
        }
    }

}
