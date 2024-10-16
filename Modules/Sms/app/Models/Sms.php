<?php

namespace Modules\Sms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Sms\Database\Factories\SmsFactory;

class Sms extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): SmsFactory
    // {
    //     // return SmsFactory::new();
    // }
}
