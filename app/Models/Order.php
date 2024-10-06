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
    // تعریف رابطه با مدل Cart  
    public function cart():BelongsTo 
    {  
        return $this->belongsTo(Carts::class, 'unique_code', 'unique_code');  
    }  
 
    // تعریف رابطه با مدل Address  
    public function address():BelongsTo  
    {  
        return $this->belongsTo(Adress::class);  
    }
}
