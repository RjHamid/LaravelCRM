<?php

namespace Modules\Rating\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\User\Models\User;

// use Modules\Rating\Database\Factories\RateFactory;

class Rate extends Model
{
    use HasFactory;

    protected $table = 'ratings';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected $guarded = [];

}
