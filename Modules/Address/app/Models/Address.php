<?php

namespace Modules\Address\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Order\Models\Order;
use Modules\User\Models\User;

// use Modules\Address\Database\Factories\AddressFactory;

class Address extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',  
        'description', 
    ];

    // protected static function newFactory(): AddressFactory
    // {
    //     // return AddressFactory::new();
    // }
    public function user():BelongsTo
    {  
        return $this->belongsTo(User::class);  
    }
    public function order(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
