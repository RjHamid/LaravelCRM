<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categories extends Model
{
    use HasFactory;

    public function children(): HasMany  
    {  
        return $this->hasMany(Categories::class, 'parent_id');  
    }  

    // تعریف رابطه با دسته‌بندی والد  
    public function parent(): BelongsTo 
    {  
        return $this->belongsTo(Categories::class, 'parent_id');  
    }
}
