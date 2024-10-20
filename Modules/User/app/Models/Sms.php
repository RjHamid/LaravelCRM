<?php

namespace Modules\User\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\User\Database\Factories\SmsFactory;

class Sms extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [  
        'phone',
        'code',  
        'status',  
        'expiration_time',  
    ];  

    protected $casts = [  
        'expiration_time' => 'datetime',  
    ];

    // protected static function newFactory(): SmsFactory
    // {
    //     // return SmsFactory::new();
    // }
}
