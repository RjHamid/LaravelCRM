<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'unique_code',  
        'address_id',  
        'gate',  
        'price_total',  
        'transaction_id',  
        'status', 
    ];
    public function carts(): BelongsTo
    {
        return $this->belongsTo(Carts::class);
    }
    public function address():BelongsTo 
    {  
        return $this->belongsTo(Address::class);  
    } 
}
