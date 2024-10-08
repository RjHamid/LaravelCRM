<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Carts extends Model
{
    use HasFactory;

    protected $fillable = [  
        'user_id',  
        'product_id',  
        'unique_code',  
        'count',  
        'price_unit',  
        'status',  
    ];  

    // رابطه با مدل User  
    public function user():BelongsTo 
    {  
        return $this->belongsTo(User::class);  
    }  

    // رابطه با مدل Product  
    public function product():BelongsTo
    {  
        return $this->belongsTo(Products::class);  
    }
}
