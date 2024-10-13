<?php

namespace Modules\Carts\Models;

use App\Models\Products;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Order\Models\Order;

// use Modules\Carts\Database\Factories\CartsFactory;

class Carts extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',  
        'product_id',  
        'unique_code',  
        'count',  
        'price_unit',  
        'status',
    ];
    public function order(): HasMany
    {
        return $this->hasMany(Order::class);
    }
    public function user():BelongsTo  
    {  
        return $this->belongsTo(User::class);  
    }  

    // تعریف رابطه با مدل Product  
    public function product(): BelongsTo
    {  
        return $this->belongsTo(Products::class);  
    }
    // protected static function newFactory(): CartsFactory
    // {
    //     // return CartsFactory::new();
    // }
}
