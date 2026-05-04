<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StockTransaction;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'sku',
        'name',
        'category',
        'unit',
        'status',
        'minimum_stock'
    ];

    // 👇 Relationship (Product → many StockTransactions)
    public function transactions()
    {
        return $this->hasMany(StockTransaction::class);
    }

    // 👇 STEP 11: Current Stock Calculation
    public function getStockAttribute()
    {
        $in = $this->transactions()->where('type', 'in')->sum('quantity');
        $out = $this->transactions()->where('type', 'out')->sum('quantity');

        return $in - $out;
    }
}