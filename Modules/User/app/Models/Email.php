<?php

namespace Modules\User\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\User\Database\Factories\EmailFactory;

class Email extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'email',
        'code',    
        'expiration_time',
    ];

    // protected static function newFactory(): EmailFactory
    // {
    //     // return EmailFactory::new();
    // }
}
