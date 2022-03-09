<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;

class ProductsController extends Controller
{

    public function index()
    {
        return view('product');
    }

    public function getAll()
    {
        try {

            return Products::orderBy('id','Asc')->paginate(10);

        } catch (\Exception $ex) {
            return response()->json([
                'status' => 'Error',
                'message' => $ex->getMessage()
            ],500);
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        try {

            $header = ['Content-Type: application/json'];

            $product = new Products;
            $product->create($request->all());

        } catch(\Exception $ex) {
            return response()->json([
                'status' => 'error',
                'message' => $ex->getMessage()
            ],500,$header);
        }
    }

    public function show(Products $products)
    {
        return $products;
    }

    public function edit(Products $products)
    {
        //
    }

    public function update(Request $request)
    {
        $p = Products::find($request->id);

        $p->name = $request->name;
        $p->description = $request->description;
        $p->stock = $request->stock;
        $p->update();
    }


    public function destroy(Request $request)
    {
        $p = Products::find($request->id);
        $p->delete();
    }
}
