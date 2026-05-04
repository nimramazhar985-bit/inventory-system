<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Supplier;

class StockTransaction extends Model
{
    use HasFactory;

    /**
     * Mass assignable fields
     */
    protected $fillable = [
        'product_id',
        'supplier_id',
        'type',        // in / out
        'quantity',
        'date',
        'remarks'
    ];

    /**
     * Each stock transaction belongs to one product
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Each stock transaction belongs to one supplier (optional for stock out)
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}