<?php

namespace Modules\Email\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\User\Models\User;

// use Modules\Email\Database\Factories\EmailFactory;

class Email extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'email',
        'user_id', 
        'code',    
        'expiration_time', 
    ];
    public function user():BelongsTo  
    {  
        return $this->belongsTo(User::class);  
    } 
    // protected static function newFactory(): EmailFactory
    // {
    //     // return EmailFactory::new();
    // }
}
