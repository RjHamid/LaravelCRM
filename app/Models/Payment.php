<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [  
        'order_id',  
        'tracking_code',  
        'card_pin',  
        'total_price',  
        'status',  
    ];  

    // تعریف رابطه با مدل Order  
    public function order():BelongsTo  
    {  
        return $this->belongsTo(Order::class);  
    }  
}
