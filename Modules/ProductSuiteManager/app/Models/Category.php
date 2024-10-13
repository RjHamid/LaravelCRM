<?php

namespace Modules\ProductSuiteManager\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use voku\helper\ASCII;

// use Modules\ProductSuiteManager\Database\Factories\CategoryFactory;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = [];

    protected $table = 'categories';


    public function parent()
    {
        return $this->belongsTo(Category::class,'parent_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

     public  function getRouteKeyName  ()
    {
        return
            'slug'
        ;
    }

}
