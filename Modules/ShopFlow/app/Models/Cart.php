<?php

namespace Modules\ShopFlow\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\ProductSuiteManager\Models\Product;

// use Modules\ShopFlow\Database\Factories\CartFactory;

class cart extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
