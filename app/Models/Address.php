<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Address extends Model
{
    use HasFactory;

    
    protected $fillable = [  
        'user_id',  
        'description',  
    ];  

    // تعریف رابطه با مدل User  
    public function user():BelongsTo
    {  
        return $this->belongsTo(User::class);  
    }
    public function order(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}