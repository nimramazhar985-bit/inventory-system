<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\StockTransaction;

class StockController extends Controller
{
    // 📄 Stock page
    public function index()
    {
        $products = Product::all();
        $stocks = StockTransaction::with('product')->latest()->get();

        return view('stock.index', compact('products', 'stocks'));
    }

    // 📥 Stock In (AJAX + normal support)
    public function stockIn(Request $request)
    {
        StockTransaction::create([
            'product_id' => $request->product_id,
            'type' => 'in',
            'quantity' => $request->quantity,
            'remarks' => $request->remarks
        ]);

        // AJAX response
        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Stock Added Successfully'
            ]);
        }

        // normal form submit fallback
        return back()->with('success', 'Stock Added Successfully');
    }

    // 📤 Stock Out
    public function stockOut(Request $request)
    {
        StockTransaction::create([
            'product_id' => $request->product_id,
            'type' => 'out',
            'quantity' => $request->quantity,
            'remarks' => $request->remarks
        ]);

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Stock Removed Successfully'
            ]);
        }

        return back()->with('success', 'Stock Removed Successfully');
    }
}