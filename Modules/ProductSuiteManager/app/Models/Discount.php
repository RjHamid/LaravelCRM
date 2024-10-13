<?php

namespace Modules\ProductSuiteManager\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\ProductSuiteManager\Database\Factories\DiscountFactory;

class Discount extends Model
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
