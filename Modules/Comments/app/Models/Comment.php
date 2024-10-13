<?php

namespace Modules\Comments\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Comments\Database\Factories\CommentFactory;

class Comment extends Model
{
    use HasFactory;


    protected $table = 'comments';
    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = [];



    /*public function user()
    {
        return $this->belongsTo()
    }*/
}
