<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $data = [
            'products' => $products,
            'subtitle' => 'Product List',
        ];
        return view('products.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'quantity' => 'required|integer',
            'price' => 'required|decimal:2',
            'supplier' => 'required',
        ]);
  
        $sku = $this->randomId();

        $product = Product::create([
            'name' => $data['name'],
            'sku' => $sku,
            'quantity' => $data['quantity'],
            'price' => $data['price'],
            'supplier' => $data['supplier'],
        ]);

        return response()->json([
            'success' => true,
            'product' => $product,
        ]);
    }

    private function randomId()
    {
        $sku = Str::random(4);
        $validator = Validator::make(['sku'=>$sku],['code'=>'unique:products,sku']);

        if($validator->fails()){
            return $this->randomId();
        }

        return $sku;
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required',
            'quantity' => 'required|integer',
            'price' => 'required|decimal:2',
            'supplier' => 'required',
        ]);

        $product->update([
            'name' => $data['name'],
            'quantity' => $data['quantity'],
            'price' => $data['price'],
            'supplier' => $data['supplier'],
        ]);

        return redirect()->route('products', $product)->with('success', 'Product Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Product::findOrFail($id);  
        $data->delete();  

        return response()->json();
    }



}
