<?php

namespace Modules\ShopFlow\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\ShopFlow\Database\Factories\OrderFactory;

class order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = [];

    public function carts()
    {
        return $this->hasMany(cart::class , 'unique_code');
    }

    public function progress()
    {
        return $this->belongsTo(OrderProgress::class,'progress_id');
    }
}
