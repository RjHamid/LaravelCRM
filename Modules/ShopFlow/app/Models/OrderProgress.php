<?php

namespace Modules\ShopFlow\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\ShopFlow\Database\Factories\OrderProgressFactory;

class OrderProgress extends Model
{
    use HasFactory;

    protected $table = 'orders_progress';

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = [];


}
