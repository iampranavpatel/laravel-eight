<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     *Listing of products
     */
    public function index(){
        $products = Product::latest()->paginate(3);
        
        return view('product.index',compact('products'))
        ->with('i', (request()->input('page', 1) - 1) * 3);
    }

    /*
    * Addition page blade
    */
    public function add(){
        return view('product.add');
    }

    /*
    * Addition page data handle
    */
    public function store(Request $request){
        $validator = $request->validate([
            'name' => 'required|max:255',
            'detail' => 'required',
            'created_at' => 'date',
        ]);

        $storeData = Product::create($validator);

        if($storeData){
            return redirect()->route('product.index')
            ->with('success', 'Product created successfully.');
        }
    }

    /*
    * View product details
    */
    public function show($id){
        $singleProduct = Product::where('id' , $id)->first();
        
        return view('product.show',compact('singleProduct'));
    }

    /*
    * Fetch product details
    */
    public function edit($id){
        $singleProduct = Product::where('id' , $id)->first();
        
        return view('product.edit',compact('singleProduct'));
    }

    /*
    * Update product details
    */
    public function update(Request $request, $id){
        $singleProduct = Product::where('id', $id)->first();

        $request->validate([
            'name' => 'required|max:255',
            'detail' => 'required',
            'updated_at' => 'date',
        ]);

        $updateData = $singleProduct->update($request->all());
        
        if ($updateData) {
            return redirect()->route('product.index')
                ->with('success', 'Product updated successfully.');
        }
    }

    /*
    * Delete product details
    */
    public function delete(Request $request, $id){
        $singleProduct = Product::where('id', $id)->first();
        $singleProduct->delete();
        
        return redirect()->route('product.index')
            ->with('success', 'Product deleted successfully');

    }

    /*
    * Filter
    */
    public function search(Request $request){
        $searchTerm = $request->search;
        
        if (count($request->all())) {
            $validator = $request->validate([
                'search' => 'required',
            ]);
        }else{
           return redirect()
            ->route('product.index')
            ->with('error', 'The search field is required.');
        }
        
        if($validator){

            $products = Product::where('name',$searchTerm)
            ->paginate(3);
            
            return view('product.index', compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 3);

        }
    }

}
