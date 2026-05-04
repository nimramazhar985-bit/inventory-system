<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\StockTransaction;

class DashboardController extends Controller
{
    public function index()
    {
        // Total products
        $productsCount = Product::count();

        // Total stock (ALL products combined)
        $totalStock = Product::all()->sum('stock');

        // ✅ FIXED LOW STOCK LOGIC
        $lowStock = Product::all()->filter(function ($product) {
            return $product->stock < $product->minimum_stock;
        })->count();

        // Total stock in
        $stockIn = StockTransaction::where('type', 'in')->sum('quantity');

        // Total stock out
        $stockOut = StockTransaction::where('type', 'out')->sum('quantity');

        return view('dashboard', compact(
            'productsCount',
            'totalStock',
            'lowStock',
            'stockIn',
            'stockOut'
        ));
    }
}