<?php

namespace Modules\User\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\ShopFlow\Models\order;

// use Modules\User\Database\Factories\AddressFactory;

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
    public function orders(): HasMany
    {
        return $this->hasMany(order::class);
    }
    // protected static function newFactory(): AddressFactory
    // {
    //     // return AddressFactory::new();
    // }
}
