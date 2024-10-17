<?php

namespace Modules\Sms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\User\Models\User;

// use Modules\Sms\Database\Factories\SmsFactory;

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
    public function user():BelongsTo  
    {  
        return $this->belongsTo(User::class);  
    } 
    // protected static function newFactory(): SmsFactory
    // {
    //     // return SmsFactory::new();
    // }
}
