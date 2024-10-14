<?php

namespace Modules\ProductSuiteManager\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\ProductSuiteManager\Database\Factories\ProductFactory;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public  function getRouteKeyName  ()
    {
        return
            'slug'
            ;
    }

    public function discount()
    {
        return $this->hasOne(Discount::class);
    }

    public function getHasDiscountAttribute() :bool
    {

        return $this->discount()->exists();

    }

    public function getDiscountPercentAttribute()
    {
        if ($this->has_discount)
        {
            return $this->discount->percent;
        }
    }

    public function getPriceWithDiscountAttribute()
    {
        if (!$this->has_discount)
        {
            return $this->price;
        }
        else
        {
            return $this->price - ($this->price * $this->discount_percent/100);
        }
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }



}
