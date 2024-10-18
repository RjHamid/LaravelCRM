<?php

namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\ProductSuiteManager\Models\Category;
use Modules\User\Models\User;

// use Modules\Blog\Database\Factories\BlogFactory;

class Blog extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [  
        'user_id',  
        'category_id',  
        'title',  
        'description',  
        'pic',  
    ];  

   
    public function user():BelongsTo  
    {  
        return $this->belongsTo(User::class);  
    }  

    public function category():BelongsTo  
    {  
        return $this->belongsTo(Category::class);  
    }

    // protected static function newFactory(): BlogFactory
    // {
    //     // return BlogFactory::new();
    // }
}
