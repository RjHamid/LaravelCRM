<?php

namespace Modules\Rating\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Rating\Database\Factories\RateFactory;

class Rate extends Model
{
    use HasFactory;

    protected $table = 'ratings';

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = [];

}
