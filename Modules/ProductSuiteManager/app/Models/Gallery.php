<?php

namespace Modules\ProductSuiteManager\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\ProductSuiteManager\Database\Factories\GalleryFactory;

class Gallery extends Model
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
